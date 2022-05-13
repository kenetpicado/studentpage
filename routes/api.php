<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\MatriculaController as MatriculaV1;
use App\Http\Controllers\Api\V1\PromotorController as PromotorV1;
use App\Http\Controllers\Api\V1\GrupoController as GrupoV1;
use App\Http\Controllers\Api\V1\CursoController as CursoV1;
use App\Http\Controllers\Api\V1\DocenteController as DocenteV1;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('v1/matriculas', MatriculaV1::class)
      ->only(['index', 'show', 'destroy', 'store'])
      ->middleware('auth:sanctum');

Route::apiResource('v1/promotores', PromotorV1::class)
        ->only(['index', 'show'])
        ->middleware('auth:sanctum');

Route::apiResource('v1/grupos', GrupoV1::class)
        ->only(['index', 'show'])
        ->middleware('auth:sanctum');

Route::apiResource('v1/cursos', CursoV1::class)
        ->only(['index', 'show'])
        ->middleware('auth:sanctum');

Route::apiResource('v1/docentes', DocenteV1::class)	
        ->only(['index', 'show'])
        ->middleware('auth:sanctum');

Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login']);
