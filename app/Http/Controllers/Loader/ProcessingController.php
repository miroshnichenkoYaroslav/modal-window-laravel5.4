<?php

namespace App\Http\Controllers\Loader;

use App\DiagnosticFile;
use App\DiagnosticResult;

use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;

class ProcessingController extends Controller
{
    /*
    * Методы отвечающие за обработку загруженного файла
    */

    public function loadResult($id)
    {
        $diagnosticFile = DiagnosticFile::findOrFail($id);

        return view('loader.load-result', [
            'fileData'  => $diagnosticFile,
        ]);
    }

    /**
     * Обработка загруженного файла
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function processingFile(Request $request)
    {
        $fileID = $request->input('diagnostic_file_id');
        DiagnosticResult::parseFile($fileID);

        return redirect(route('loader/processingResult', [
            'fileID' => $fileID,
        ]));
    }

    //TODO: Припилить midlwear не дающий выйти из обработчика ошибок парсинга
    //      до принятия решения принять результаты парсинга или удалить

    /**
     * Отображение результатов парсинга файла
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processingResult($id)
    {
        $results = DiagnosticResult::
            where('diagnostic_file_id', $id)
            ->get();

        if (!$results->count()) {
            session()->flash('message', 'Файл не найден');

            return redirect()->route('loader/index');
        }

        $erroredFiles = $results->filter(function ($result) {
            return $result->status === 'error';
        });

        $file = DiagnosticFile::find($id);
        if ($erroredFiles->count()) {
            $file->status = 'errors';
            $file->save();

            return view("loader.processing-result", [
                'fileID'    => $id,
            ]);
        } else {
            $file->status = 'accepted';
            $file->save();

            session()->flash('message', 'Файл успешно обработан');
            return redirect()->route('loader/index');
        }

    }

    /**
     * Данные о результате парсинга файла
     *
     * @param Request $request
     * @param Datatables $dataTables
     * @return \Illuminate\Http\JsonResponse
     */
    public function processingResultData(Request $request, Datatables $dataTables)
    {
        $fileID = $request->id;
        $diagnosticResults = DiagnosticResult::
        with(['diagnosticFile', 'subject', 'school', 'municipality', 'region'])
            ->where('diagnostic_file_id', $fileID)
            ->where('status', 'error')
            ->select('diagnostic_results.*');

        return $dataTables
            ->eloquent($diagnosticResults)
            ->editColumn('diagnostic_file.exam_date', function ($data) {
                return date("d.m.Y", strtotime($data->created_at));
            })
            ->addColumn('test', function ($data) {
                $xml = simplexml_load_string($data->xml_result);
                $xml = json_encode($xml);
                $xml = json_decode($xml,TRUE);
                return $xml['test'];
            })
            ->editColumn('errors', function ($data) {
                $errors = json_decode($data->errors,TRUE);
                return $errors;
            })
            ->addColumn('details_url', function($data) {
                return url('loader/processing/duplicates/' . $data->id);
            })
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Данные о дублирующихся строках в файле
     *
     * @param Request $request
     * @param Datatables $dataTables
     * @return \Illuminate\Http\JsonResponse
     */
    public function processingResultDuplicatesData(Request $request, Datatables $dataTables)
    {
        $fileID = $request->file_id;
        $rowID = $request->row_id;

        $duplicates = DiagnosticResult::find($rowID, ['duplicates']);
        $duplicates = json_decode($duplicates->duplicates, true);

        $diagnosticResults = DiagnosticResult::
        with(['diagnosticFile', 'subject', 'school', 'municipality', 'region'])
            ->where('diagnostic_results.diagnostic_file_id', $fileID)
            ->whereIn('diagnostic_results.id', $duplicates)
            ->select('diagnostic_results.*');

        return $dataTables
            ->eloquent($diagnosticResults)
            ->editColumn('diagnostic_file.exam_date', function ($data) {
                return date("d.m.Y", strtotime($data->created_at));
            })
            ->addColumn('test', function ($data) {
                $xml = simplexml_load_string($data->xml_result);
                $xml = json_encode($xml);
                $xml = json_decode($xml,TRUE);
                return $xml['test'];
            })
            ->editColumn('errors', function ($data) {
                $errors = json_decode($data->errors,TRUE);
                return $errors;
            })
            ->addColumn('action', function ($data) {
                $editBtn = '<button class="accept_row" data-id="'. $data->id .'" type="button" class="btn btn-primary btn-sm" title="Принять">П</span></button>';
                $deleteBtn = '<button class="delete_row" data-id="'. $data->id .'" type="button" class="btn btn-primary btn-sm" title="Удалить">У</button>';
                return $editBtn . ' ' . $deleteBtn;
            })
            ->addIndexColumn()
            ->make(true);
    }

}
