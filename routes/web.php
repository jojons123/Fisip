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

//Route::get('/form', 'FormController@index');
//Route::post('/form', 'FormController@store');
Route::view('/contact', 'contact');

Route::view('/about', 'about');

//Route::get('/upload', 'FormController@getUploadPage');
//Route::post('/upload', 'FormController@storeUpload');

Route::get('/test', function(){

});


Route::group(['middleware' => 'can:admin-page'], function(){
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/mahasiswa/{id}', 'AdminController@detailMahasiswa');
    Route::get('/admin/upload', 'AdminController@getUploadPage');
    Route::get('/admin/upload/download/{id}', 'AdminController@downloadUploadFile');
    Route::post('/admin/upload/destroy', 'AdminController@deleteUploadFile');

    Route::get('/ajax/mahasiswa', 'AdminController@getDataMahasiswa');
    Route::get('/ajax/mahasiswa/upload', 'AdminController@getDataUpload');
});

Route::group(['middleware' => 'can:mahasiswa-page'], function(){
    Route::get('/form-1', 'FormController@getForm1');
    Route::get('/form-2', 'FormController@getForm2');
    Route::post('/form-1', 'FormController@storeForm1');
    Route::post('/form-2', 'FormController@storeForm2');

    Route::post('/dashboard/profile/update', 'MahasiswaController@updateProfile')->name('update-profile');

    Route::get('/dashboard', 'MahasiswaController@index');
    Route::get('/dashboard/form-1', 'MahasiswaController@showEditForm1');
    Route::get('/dashboard/form-2', 'MahasiswaController@showEditForm2');
    Route::post('/dashboard/form-1', 'MahasiswaController@updateForm1');
    Route::post('/dashboard/form-2', 'MahasiswaController@updateForm2');
});

//Route::get('test', function(){
//    $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Apikey', '875dc5bf-1db8-4434-b50b-74d49c583f29');
//    $apiInstance = new Swagger\Client\Api\ConvertDocumentApi(
//        new GuzzleHttp\Client(),
//        $config
//    );
//
//    $headers = [
//        'Content-type'        => 'application/pdf',
//        'Content-Disposition' => 'attachment; filename="kontol.pdf"',
//    ];
//
//    $input_file = public_path('Template Laporan.docx');
//    try {
//        $result = $apiInstance->convertDocumentDocxToPdf($input_file);
//        return \Response::make($result, 200, $headers);
//        return response()->download($result);
//    } catch (Exception $e) {
//        echo 'Exception when calling ConvertDocumentApi->convertDocumentDocxToPdf: ', $e->getMessage(), PHP_EOL;
//    }
//});


//Route::get('/drive', 'DriveController@getDrive');