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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('atencion','AtencionController')->middleware(['auth']);


Route::get('expediente/get_atencion','ExpedienteController@get_atencion')->name('expediente.get_atencion');
Route::get('expediente/get_trabajador','ExpedienteController@get_trabajador')->name('expediente.get_trabajador');

Route::resource('expediente','ExpedienteController')->middleware(['auth']);

Route::resource('auditoria','AuditoriaController')->middleware(['auth']);








