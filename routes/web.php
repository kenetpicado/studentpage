<?php

use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\Generate;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PromotorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Restablecer pin
Route::post('cambiar/pin', [Generate::class, 'cambiar_pin'])->name('cambiar.pin');
Route::get('grupos/{grupo}/status', [GrupoController::class, 'status'])->name('grupos.status');
Route::get('grupos/terminados', [GrupoController::class, 'showClosed'])->name('grupos.closed');
Route::get('grupos/terminados/{id}', [GrupoController::class, 'showThisClosed'])->name('grupos.thisClosed');

//Recursos
Route::resource('/', HomeController::class);
Route::resource('cursos', CursoController::class)->except(['show']);
Route::resource('docentes', DocenteController::class);
Route::resource('matriculas', MatriculaController::class);
Route::resource('grupos', GrupoController::class);
Route::resource('promotores', PromotorController::class)
    ->parameters(['promotores' => 'promotor']);

Route::resource('consulta', ConsultaController::class)
    ->only(['index', 'show']);

//Login
Auth::routes(['register' => false]);
