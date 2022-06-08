<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MatriculaController;
use App\Http\Controllers\Api\LoginController;
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

        Route::apiResource('v1/matriculas', MatriculaController::class)
                ->only(['index', 'show', 'store']);

        Route::get('/user', function (Request $request) {
                return $request->user();});

});
