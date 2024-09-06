<?php

use Illuminate\Support\Facades\Route;

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
    return view('pages.dashboard');
});



// Dashboard
Route::get('/dashboard', 'DashboardController@index');


// Admin
Route::get('/admin', 'AdminController@index');
Route::get('/showTableAdmin', 'AdminController@show');
Route::post('/addAdmin', 'AdminController@add');
Route::delete('/deleteAdmin/{id}', 'AdminController@delete');



// Karyawan
Route::get('/karyawan', 'KaryawanController@index');
Route::get('/showTableKaryawan', 'KaryawanController@show');
Route::post('/addKaryawan', 'KaryawanController@add');
Route::get('/getEditKaryawan/{id}', 'KaryawanController@getUpdate');
Route::put('/putEditKaryawan/{id}', 'KaryawanController@update');
Route::delete('/deleteKaryawan', 'KaryawanController@delete');



// Bagian
Route::get('/bagian', 'BagianController@index');
Route::get('/showTableBagian', 'BagianController@show');
Route::post('/addBagian', 'BagianController@add');
Route::put('/editBagian', 'BagianController@update');
Route::delete('/deleteBagian/{id}', 'BagianController@delete');


// Data Gaji
Route::get('/dataGaji', 'DataGajiController@index');




// Slip Gaji
Route::get('/slipGaji', 'SlipGajiController@index');
