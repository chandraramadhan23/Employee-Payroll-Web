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

Route::get('/dashboard', 'DashboardController@index');

Route::get('/admin', 'AdminController@index');

Route::get('/karyawan', 'KaryawanController@index');
Route::get('/showTableKaryawan', 'KaryawanController@show');
Route::post('/addKaryawan', 'KaryawanController@add');
Route::get('/getEditKaryawan/{id}', 'KaryawanController@getUpdate');
Route::put('/putEditKaryawan/{id}', 'KaryawanController@update');
Route::delete('/deleteKaryawan', 'KaryawanController@delete');

Route::get('/bagian', 'BagianController@index');
Route::get('/showTableBagian', 'BagianController@show');
Route::post('/addBagian', 'BagianController@add');
Route::put('/editBagian', 'BagianController@update');
Route::delete('/deleteBagian/{id}', 'BagianController@delete');
