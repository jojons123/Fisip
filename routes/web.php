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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/form', 'FormController@index');
Route::post('/form', 'FormController@store');
Route::view('/contact', 'contact');

Route::get('/upload', 'FormController@getUploadPage');
Route::post('/upload', 'FormController@storeUpload');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/mahasiswa/{id}', 'AdminController@detailMahasiswa');
Route::get('/admin/upload', 'AdminController@getUploadPage');
Route::get('/admin/upload/download/{id}', 'AdminController@downloadUploadFile');
Route::post('/admin/upload/destroy', 'AdminController@deleteUploadFile');

Route::get('/ajax/mahasiswa', 'AdminController@getDataMahasiswa');
Route::get('/ajax/mahasiswa/upload', 'AdminController@getDataUpload');
