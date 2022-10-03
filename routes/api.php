<?php

namespace App\Http\Controllers\Api;

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

Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::post('logout', [LoginController::class, 'logout']);

        Route::apiResource('v1/matriculas', MatriculaController::class);

        Route::apiResource('v1/grupos', GrupoController::class)
                ->only(['show', 'index']);

        Route::get('v1/grupos-notas/{id}', [GrupoController::class, 'create_nota']);
        Route::post('v1/grupos-notas', [GrupoController::class, 'store_nota']);

        Route::get('consulta', [ConsultaController::class, 'index']);
        Route::get('consulta/notas/{id}', [ConsultaController::class, 'notas']);
        Route::get('consulta/mensajes/{grupo_id}', [ConsultaController::class, 'mensajes']);

        Route::get('/user', function (Request $request) {
                return $request->user();
        });
});
