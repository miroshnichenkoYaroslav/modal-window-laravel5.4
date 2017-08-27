<?php

namespace App\Http\Controllers\Loader;

use App\DiagnosticFile;
use App\DiagnosticResult;
use App\DiagnosticType;
use App\DiagnosticSubject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class FileActionsController
 * @package App\Http\Controllers\Loader
 */
class FileActionsController extends Controller
{
    /**
     * Форма редактирования данных о файле
     *
     * @param int       $id
     * @param Request   $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editForm($id)
    {
        $diagnosticFile = DiagnosticFile::find($id);

        if ($diagnosticFile) {
            return view('loader.edit-file', [
                'types'     => DiagnosticType::all()->toArray(),
                'subjects'  => DiagnosticSubject::all()->toArray(),
                'years'     => array_combine(range(date("Y"), date("Y") + 20), range(date("Y"), date("Y") + 20)),
                'file'      => $diagnosticFile,
            ]);
        } else {
            session()->flash('message', 'Указанный файл не найде');

            return redirect(route('loader/index'));
        }

    }

    /**
     * Редактирование данных о файле
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Request $request)
    {
        //TODO: Имеет смысл не давать возможность изменять тип диагностики,
        //      т.к. парсинг файла происходит при загрузке и тип парсинга определяется по выбранному типу файла
        //      после смены его типа необходимо проводить парсинг заново.

        //TODO: Еще раз подумать о проверке соответсвия файла выбранному типу!

        $this->validate(
            $request,
            [
                'diagnostic_type_id' => 'required',
                'diagnostic_subject_id' => '',
                'year' => 'required',
                'exam_date' => 'required',
            ],
            [
                'diagnostic_type_id.required' => 'Необходимо указать тип диагностики!',
                'year.required' => 'Необходимо указать год диагностики!',
                'exam_date.required' => 'Необходимо указать дату экзамена!',
            ]
        );

        $fileID = $request->file_id;
        $diagnosticFile = DiagnosticFile::find($fileID);

        if ($diagnosticFile) {
            $diagnosticFile->fill($request->all());
            $diagnosticFile->save();
        } else {
            $request->session()->flash('message', 'Файл не найден!');
        }

        $request->session()->flash('message', 'Данные файла успешно обновлены!');
        return redirect('loader');
    }

    /**
     * Помечает файл как принятый после обработки
     *
     * @param Request $request
     */
    public function accept(Request $request)
    {
        $file = DiagnosticFile::find($request->id);
        $file->status = 'accepted';
        $file->save();

        $request->session()->flash('message', 'Файл и сопутствующие данные успешно приняты!');
        return redirect('loader');
    }

    /**
     * Удаление загруженного файла. Файл и записи в БД о нем полностью удаляются
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {
        $fileID = $request->file_id;
        $diagnosticFile = DiagnosticFile::find($fileID);

        if ($diagnosticFile) {
            $filePath = storage_path('app/' . $diagnosticFile->file_path);
            if (file_exists($filePath) && is_file($filePath)){
                unlink($filePath);
            }
            $diagnosticFile->delete();
        } else {
            $request->session()->flash('message', 'Файл и сопутствующие данные успешно удалены!');
        }

        DiagnosticResult::where('diagnostic_file_id', $fileID)->delete();

        $request->session()->flash('message', 'Файл и сопутствующие данные успешно удалены!');
        return redirect('loader');
    }
}
