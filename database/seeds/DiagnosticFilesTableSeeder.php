<?php

use App\DiagnosticFile;
use Illuminate\Database\Seeder;

class DiagnosticFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diagnostic_files')->insert([
                'file_name'             => '1-тестовый-два дубля.xlsx',
                'file_path'             => 'diagnostic_files/yZ1rbDmY41HLqyJhD3RgicEvrzrwWskxgYYSVUZK.xlsx',
                'user_id'               => '1',
                'diagnostic_type_id'    => '1',
                'diagnostic_subject_id' => '1',
                'year'                  => '2027',
                'exam_date'             => '2017-08-24',
                'status'                => 'errors',
                'created_at'            => '2017-08-17 16:09:22',
                'updated_at'            => '2017-08-17 16:09:22',
                'deleted_at'            => '2017-08-19 16:10:45',
            ]);
        DB::table('diagnostic_files')->insert([
                'file_name'             => '1-тестовый-без ошибок.xlsx',
                'file_path'             => 'diagnostic_files/QLRd5J9vpeR0ltAfsLryX7k2ZdAnbUHxSVRl7yAZ.xlsx',
                'user_id'               => '1',
                'diagnostic_type_id'    => '1',
                'diagnostic_subject_id' => '1',
                'year'                  => '2022',
                'exam_date'             => '2017-08-24',
                'status'                => 'accepted',
                'created_at'            => '2017-08-17 16:09:22',
                'updated_at'            => '2017-08-17 16:09:22',
                
            ]);
        DB::table('diagnostic_files')->insert([
                'file_name'             => '1-тестовый-два дубля.xlsx',
                'file_path'             => 'diagnostic_files/WVxwld6mh3eSL3XTrDhQK2SBtxftfsDJkgfJJSrZ.xlsx',
                'user_id'               => '1',
                'diagnostic_type_id'    => '1',
                'diagnostic_subject_id' => '2',
                'year'                  => '2033',
                'exam_date'             => '2017-08-24',
                'status'                => 'accepted',
                'created_at'            => '2017-08-17 16:09:22',
                'updated_at'            => '2017-08-17 16:09:22',
                
            ]);
        DB::table('diagnostic_files')->insert([
                'file_name'             => '1-тестовый-дубль-несколько ошибок.xlsx',
                'file_path'             => 'diagnostic_files/eCl1X87tBtUMaf8dnxfZuiTQEpw7fMfDopOx6mc2.xlsx',
                'user_id'               => '1',
                'diagnostic_type_id'    => '1',
                'diagnostic_subject_id' => '4',
                'year'                  => '2035',
                'exam_date'             => '2017-08-24',
                'status'                => 'accepted',
                'created_at'            => '2017-08-17 16:09:22',
                'updated_at'            => '2017-08-17 16:09:22',
                
            ]);
        DB::table('diagnostic_files')->insert([
                'file_name'             => '2 - укороченый - 1совп.xlsx',
                'file_path'             => 'diagnostic_files/qSkieyp11JWmho9zbIctseeg4Vh3HKpH1KA9d05A.xlsx',
                'user_id'               => '1',
                'diagnostic_type_id'    => '2',
                'diagnostic_subject_id' => '3',
                'year'                  => '2035',
                'exam_date'             => '2017-08-24',
                'status'                => 'accepted',
                'created_at'            => '2017-08-17 16:09:22',
                'updated_at'            => '2017-08-17 16:09:22',
                
            ]);
        DB::table('diagnostic_files')->insert([
                'file_name'             => '2 - укороченый - челсовп.xlsx',
                'file_path'             => 'diagnostic_files/LZ7cRZVDewPK3jBStrEuT6yxkfsdHslhPL0F8Oxl.xlsx',
                'user_id'               => '1',
                'diagnostic_type_id'    => '2',
                'diagnostic_subject_id' => '3',
                'year'                  => '2035',
                'exam_date'             => '2017-08-24',
                'status'                => 'accepted',
                'created_at'            => '2017-08-17 16:09:22',
                'updated_at'            => '2017-08-17 16:09:22',
                
            ]);
        DB::table('diagnostic_files')->insert([
                'file_name'             => '2 - укороченый - челсовп - Copy.xlsx',
                'file_path'             => 'diagnostic_files/zHOFMggBOi89RmtRoH4mNASx8VIvZt59cNjG2bCF.xlsx',
                'user_id'               => '1',
                'diagnostic_type_id'    => '2',
                'diagnostic_subject_id' => '4',
                'year'                  => '2035',
                'exam_date'             => '2017-08-24',
                'status'                => 'accepted',
                'created_at'            => '2017-08-17 16:09:22',
                'updated_at'            => '2017-08-17 16:09:22',
                
            ]);
    }
}
