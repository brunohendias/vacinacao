<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


Route::prefix('v1')->middleware('api')->group(function () {
    Route::prefix('fabricante')->group(function () {
        Route::get('/', 'FabricanteController@get');
        Route::get('/{fabricante}', 'FabricanteController@show');
    });
    Route::prefix('vacina')->group(function () {
        Route::get('/', 'VacinaController@get');
        Route::get('/{vacina}', 'VacinaController@show');
    });
    Route::prefix('paciente')->group(function () {
        Route::get('/', 'PacienteController@get');
        Route::get('/{paciente}', 'PacienteController@show');
    });
    Route::prefix('historico')->group(function () {
        Route::get('/{historico}', 'HistoricoController@show');
    });
});