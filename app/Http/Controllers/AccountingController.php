<?php

namespace App\Http\Controllers;

use App\DiagnosticFile;
use App\DiagnosticSubject;
use App\FederalDistrict;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    /**
     * Вывод данных о загрузке файлов и всех регионах.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $files = DiagnosticFile::fetchFilesInfo()->paginate(2);
        foreach ($files as $file) {
            $diagnostics[] = $file->name;
        }
        $regions = FederalDistrict::all();

        $subjects = DB::table('diagnostic_subjects')
            ->select('name')
            ->get();

        return view('accounting.index', compact('files', 'regions', 'subjects', 'diagnostics'));
    }

    /**
     * Выбирает регионы для конкретного округа.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax(Request $request)
    {
        if ($request->ajax()) {
             $districts = DB::table('regions')
                ->where('federal_district_id', $request->request->all()['id'])
                ->select('name', 'id')
                ->get();

            return response()->json([
                'regions' => $districts
            ]);
        }
    }

}
