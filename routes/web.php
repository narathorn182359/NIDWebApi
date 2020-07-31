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

Route::get('/', function () {

    return view('admin.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/get_data_username_6090', 'Evaluate6090Controller@get_data_user_6090')->name('get_data_username_6090');
Route::get('/index_evaluate', 'Evaluate6090Controller@index_evaluate')->name('index_evaluate');
Route::post('/save_datasetevalu6090', 'Evaluate6090Controller@save_datasetevalu6090')->name('save_datasetevalu6090');
Route::post('/get_data_userset_6090', 'Evaluate6090Controller@get_data_userset_6090')->name('get_data_userset_6090');
Route::post('/delete_userset_6090', 'Evaluate6090Controller@delete_userset_6090')->name('delete_userset_6090');
Route::get('/index_userassessor/{id}', 'Evaluate6090Controller@index_userassessor')->name('index_userassessor');
Route::get('/index_option/{assessor}/{assessed}', 'Evaluate6090Controller@index_option')->name('index_option');
Route::post('/save_select', 'Evaluate6090Controller@save_select')->name('save_select');
Route::post('/save_evar6090', 'Evaluate6090Controller@save_evar6090')->name('save_evar6090');
Route::post('/save_eva90', 'Evaluate6090Controller@save_eva90')->name('save_eva90');
Route::post('/enable90', 'Evaluate6090Controller@enable90')->name('enable90');
Route::get('/evaluation/{code_staff}/{degree}', 'PDFController@evaluation')->name('evaluation');




