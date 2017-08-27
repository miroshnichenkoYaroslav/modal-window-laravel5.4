<?php

namespace App\Http\Controllers\Loader;

use App\DiagnosticFile;
use App\DiagnosticResult;
use App\DiagnosticType;
use App\DiagnosticSubject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;

/**
 * Class LoaderController
 * @package App\Http\Controllers\Loader
 */
class LoaderController extends Controller
{
    protected $user;

    /**
     * Вывает middleware admin.
     *
     * AdministrationController constructor.
     */
    public function __construct()
    {
        $this->middleware('userRole');
        $this->middleware('notAcceptedFile');

    }


    /**
     * Главная страница раздела загрузки файлов результатов диагностики
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('loader.index');
    }

    /**
     * Формирование списка для отображения таблицы загруженных файлов на главной странице загрузки
     *
     * @param Datatables $dataTables
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexData(Datatables $dataTables, Request $request)
    {
        $query = \DB::table('diagnostic_files')
            ->leftJoin(
                'diagnostic_types',
                'diagnostic_files.diagnostic_type_id', '=', 'diagnostic_types.id'
            )
            ->leftJoin(
                'diagnostic_subjects',
                'diagnostic_files.diagnostic_subject_id', '=', 'diagnostic_subjects.id'
            )
            ->leftJoin(
                'users',
                'diagnostic_files.user_id', '=', 'users.id'
            )
            ->whereNull('diagnostic_files.deleted_at')
            ->where('diagnostic_files.status', 'accepted')
            ->where('diagnostic_files.user_id', \Auth::user()->id)
            ->select([
                'diagnostic_files.id',
                'diagnostic_files.year',
                'diagnostic_files.file_name',
                'diagnostic_files.user_id',
                'diagnostic_files.created_at',
                'diagnostic_files.exam_date',
                'diagnostic_types.id as diagnostic_type_id',
                'diagnostic_types.name as diagnostic_type_name',
                'diagnostic_subjects.id as diagnostic_subject_id',
                'diagnostic_subjects.name as diagnostic_subject_name',
                'users.fio as user_fio',
            ]);

        return $dataTables->queryBuilder($query)
            ->editColumn('created_at', function ($data) {
                return date("d.m.Y", strtotime($data->created_at));
            })
            ->addColumn('action', function ($data) {
                $editBtn = '<button type="button" class="btn-sm btn btn-primary editBtn" data-toggle="modal" data-target="#editModal" title="Редактировать файл"><span class="glyphicon glyphicon-edit"></span></button>';

                $deleteBtn='';
                if (\Auth::user()->role === 'admin'){
                    $deleteBtn = ' <button type="button" class="btn-sm btn btn-danger delete-modal deleteBtn" data-toggle="modal" data-target="#deleteConfirmation" title="Удалить файл"><span class="glyphicon glyphicon-trash"></span></button>';
                }

                return $editBtn . $deleteBtn;
            })
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {

                $createdAT = $request->input('columns.7.search.value');
                $createdAT = explode('.', $createdAT);
                $createdAT = array_reverse($createdAT);
                $createdAT = implode('-', $createdAT);

                if ($request->has('columns.7.search.value')) {
                    $query->where('diagnostic_files.created_at', 'like', "%{$createdAT}%");
                }
            })

            ->make(true);
    }

    /**
     * Отображение загруженного файла
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($id)
    {
        $diagnosticFile = DiagnosticFile::find($id);
        $typeID = $diagnosticFile->diagnostic_type_id;
        return view("loader.view-$typeID", [
            'fileID'    => $id,
        ]);
    }

    /**
     * Данные загруженного файла
     *
     * @param Datatables $dataTables
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function viewData(Datatables $dataTables, Request $request)
    {
        $id = $request->id;
        $diagnosticResults = DiagnosticResult::
        with(['diagnosticFile', 'subject', 'school', 'municipality', 'region'])
            ->where('diagnostic_file_id', $id)
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
            ->addIndexColumn()
            ->make(true);
    }


    /*
     * Работа непосредственно с файлом
     */
    /**
     * Страница с формой для загрузки файла результатов диагностики
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function load()
    {
        return view('loader.load', [
            'types' => DiagnosticType::all()->toArray(),
            'subjects' => DiagnosticSubject::all()->toArray(),
            'years' => array_combine(range(date("Y"), date("Y") + 20), range(date("Y"), date("Y") + 20))
        ]);
    }

    /**
     * Загрузка, валидация и сохранение файла результатов диагностика, для последующей передачи на обработку
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadDiagnosticFile(Request $request)
    {
        $loadErrors = null;

        $this->validate(
            $request,
            [
                'diagnostic_file'       => 'required|max:10240|mimes:xlsx',
                'diagnostic_type_id'    => 'required',
                'diagnostic_subject_id' => '',
                'year'                  => 'required',
                'exam_date'             => 'required',
            ],
            [
                'diagnostic_file.max'           => 'Максимальный размер файла 10Мб!',
                'diagnostic_file.mimes'         => 'Можно загружать только XLSX файлы!',
                'diagnostic_type_id.required'   => 'Необходимо указать тип диагностики!',
                'year.required'                 => 'Необходимо указать год диагностики!',
                'exam_date.required'            => 'Необходимо указать дату экзамена!',
            ]);

        if ($request->hasFile('diagnostic_file') && $request->file('diagnostic_file')->isValid()) {
            $path = $request->diagnostic_file->store('diagnostic_files');

            $diagnosticFile = new DiagnosticFile();

            //Будет использоваться когда реализуется форма загрузки
            $diagnosticFile->fill($request->only(['diagnostic_type_id', 'diagnostic_subject_id', 'year', 'exam_date']));

            $diagnosticFile->file_name = $request->diagnostic_file->getClientOriginalName();
            $diagnosticFile->file_path = $path;
            $diagnosticFile->user_id = \Auth::user()->id; //from user

            $diagnosticFile->save();

            /**
             * TODO: После загрузки файла юзверя переводить на страницу с выбором начать обработку файла или отказаться
             *       если отказывается файл удаляется из базы
             *       на случаай если пользователь перезагрузит страницу или оборвется интернет
             *       сделать принудительное возвращение к выбору действий над файлом до тех пор
             *       пока пользователь не примет решение
             */

            return redirect()->route(
                'loader/loadResult',[
                    'id' => $diagnosticFile->id
            ]);
        }

        return view('loader.load-result', [
            'loadErrors'  => $loadErrors,
        ]);
    }

}