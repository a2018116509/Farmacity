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
    return view('index');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Rutas para Laboratorio
Route::get('/laboratorio','App\Http\Controllers\LaboratorioController@index');
Route::post('/laboratorio/registrar','App\Http\Controllers\LaboratorioController@store');
Route::get('/laboratorio/selectLaboratorio','App\Http\Controllers\LaboratorioController@index');
//Rutas para Medicamento
Route::get('/medicamento','App\Http\Controllers\MedicamentoController@index');
Route::post('/medicamento/registrar','App\Http\Controllers\MedicamentoController@store');
Route::put('/medicamento/modificar','App\Http\Controllers\MedicamentoController@update');
Route::put('/medicamento/eliminar','App\Http\Controllers\MedicamentoController@delete');