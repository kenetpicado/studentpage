<?php

use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\Generate;
use App\Http\Controllers\PromotorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Restablecer pin
Route::post('cambiar/pin', [Generate::class, 'cambiar_pin'])->name('cambiar.pin');

Route::resource('/', HomeController::class);
Route::resource('cursos', CursoController::class);
Route::resource('docentes', DocenteController::class);

//Recurso para establcer la llave promotor
Route::resource('promotores', PromotorController::class)
    ->parameters(['promotores' => 'promotor']);

//Login
Auth::routes(['register' => false]);

//Rutas alumnos - Ver grupos
Route::get('consulta', [ConsultaController::class, 'index'])->name('consulta.index');
Route::get('consulta/{id}/notas', [ConsultaController::class, 'notas'])->name('consulta.notas');
Route::get('consulta/{id}/pagos', [ConsultaController::class, 'pagos'])->name('consulta.pagos');