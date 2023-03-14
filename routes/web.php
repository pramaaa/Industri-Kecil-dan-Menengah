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

Route::group(['middleware'=>['auth']],function(){

    // Halaman Awal
    Route::get('/', function () {
        return view('index');
    });

    // Tampilkan data
    Route::get('listdata', 'IkmController@index');

    // Input Industri
    Route::get('form-input', 'IkmController@inputform');
    Route::post('/tambahkan', 'IkmController@tambah');

    // Edit Industri
    Route::get('/industri/{id}/edit', 'IkmController@editform');
    Route::post('/industri/update/', 'IkmController@perbarui');

    // Hapus Industri
    Route::get('/industri/hapus/{id}','IkmController@hapus');
    Route::get('/industri/format','IkmController@format');

    // Cari data
    Route::get('carikan','IkmController@cari');
    Route::get('perkomoditi','IkmController@selectkomoditi');

    // Import-Export data industri
    Route::get('/industri/export_excel','IkmController@excel_export');
    Route::post('/industri/import_excel','IkmController@excel_import');

    // Tentukan Matriks Perbandingan Bobot dengan AHP
    //Route::view('/bobot','bobot');
    Route::get('/bobot','AhpController@index');
    Route::get('/matriks_p','AhpController@index2');
    Route::post('/matriks_p','AhpController@matriks_p');

    // Perhitungan Alternatif dengan WASPAS
    Route::get('/pilih_komoditi','WaspasController@index');
    Route::post('/pilih_komoditi','WaspasController@index');
    Route::post('/perhitungan','WaspasController@hitung');

    // Password
    Route::get('/repass','UserController@repass');
    Route::post('/repass','UserController@repassProcess');

    Route::get('/loginn','UserController@new');

});

// Login
Route::get('/login','UserController@index')->name('login')->middleware('guest');
Route::post('/login','UserController@authenticate');
Route::post('/logout','UserController@logout');

