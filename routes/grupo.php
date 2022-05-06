<?php

use App\Http\Controllers\GrupoController;
use Illuminate\Support\Facades\Route;

//Cambiar de grupo
Route::get('grupos/{matricula}/{grupo}/selecionar', [GrupoController::class, 'seleccionar'])
    ->name('grupos.seleccionar');

Route::put('cambiar/{pivot}', [GrupoController::class, 'cambiar'])
    ->name('grupos.cambiar');

Route::resource('grupos', GrupoController::class);
