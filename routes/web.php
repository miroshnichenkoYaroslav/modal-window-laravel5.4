<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Администрирование пользователей.
 */
Route::resource('admin', 'AdministrationController');
Route::post('/destroy','AdministrationController@destroy');

/**
 * Загрузка файлов результатов диагностики
 */
//Отображает список загруженных файлов
Route::get('/loader', 'Loader\LoaderController@index')
    ->name('loader/index');
//Выдает данные списка загруженных файлов
Route::get('/loader/files-list', 'Loader\LoaderController@indexData')
    ->name('loader/files-list');

//Отображает форму загрузки нового файла
Route::get('/loader/load', 'Loader\LoaderController@load')
    ->name('loader/load');
//Производит загрузку нового файла
Route::post('/loader/load', 'Loader\LoaderController@loadDiagnosticFile')
    ->name('loader/loadDiagnosticFile');
//Показывает информацию о загруженном файле и предостаавляет выбор дальнейших действий
Route::get('/loader/load/{id}', 'Loader\ProcessingController@loadResult')
    ->name('loader/loadResult');

//Форма редактирования файла
Route::get('/loader/edit/{id}', 'Loader\FileActionsController@editForm')
    ->name('loader/editFileForm');
//Редактирует данные о файле
Route::post('/loader/edit', 'Loader\FileActionsController@edit')
    ->name('loader/editFile');

//Принимает файл и все связанные с ним данные
Route::post('/loader/accept', 'Loader\FileActionsController@accept')
    ->name('loader/acceptFile');

//Удаляет файл и все связанные с ним данные
Route::post('/loader/delete', 'Loader\FileActionsController@delete')
    ->name('loader/deleteFile');

/**
 * Обработка загруженного файла результатов диагностики
 */
//Выбор действия над только что загруженным файлом
Route::get('/loader/processing', 'Loader\ProcessingController@processingFile')
    ->name('loader/processing');

//Если выбрана обработка запускает обработку файла
Route::post('/loader/processing', 'Loader\ProcessingController@processingFile')
    ->name('loader/processingFile');
//Если выбрана отмена удаляет файл и все что связанно с этим файлом
Route::post('/loader/processing/cancel', 'Loader\ProcessingController@processingCancel')
    ->name('loader/processingCancel');

//Отображает результат обработки файла
Route::get('/loader/processing/result/{id}', 'Loader\ProcessingController@processingResult')
    ->name('loader/processingResult');
//Выдает данные о результате обработки файла
Route::post('/loader/processing/result/data', 'Loader\ProcessingController@processingResultData')
    ->name('loader/processingResultData');
//Выдает данные о дубликатах строк файла
Route::post('/loader/processing/result/data-duplicates', 'Loader\ProcessingController@processingResultDuplicatesData')
    ->name('loader/processingResultDuplicatesData');

/**
 * Отображение обработанных файлов
 */
//Отображает обработанный файл
Route::get('/loader/view/{id}', 'Loader\LoaderController@view')
    ->name('loader/view');
//Выдает данные обработанного файла
Route::post('/loader/view', 'Loader\LoaderController@viewData')
    ->name('loader/view-data');


/**
 * Формирование отчетности.
 */
Route::get('/accounting', 'AccountingController@index')->name('accounting/index');

Route::get('/subject', 'AccountingController@ajax')->name('subject');
