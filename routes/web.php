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
    return redirect('/historico');
});

Route::prefix('fabricante')->group(function () {
    Route::get('/', 'FabricanteController@index')->name('fabricante.index');
    Route::post('/', 'FabricanteController@store');
    Route::put('/{fabricante}', 'HistoricoController@update');
});
Route::prefix('vacina')->group(function () {
    Route::get('/', 'VacinaController@index')->name('vacina.index');
    Route::post('/', 'VacinaController@store');
    Route::put('/{vacina}', 'HistoricoController@update');
});
Route::prefix('paciente')->group(function () {
    Route::get('/', 'PacienteController@index')->name('paciente.index');
    Route::post('/', 'PacienteController@store');
    Route::put('/{paciente}', 'HistoricoController@update');
});
Route::prefix('historico')->group(function () {
    Route::get('/', 'HistoricoController@index')->name('historico.index');
    Route::post('/', 'HistoricoController@store');
    Route::put('/{historico}', 'HistoricoController@update');
});