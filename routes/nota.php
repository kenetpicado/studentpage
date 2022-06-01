<?php

use App\Http\Controllers\NotaController;
use Illuminate\Support\Facades\Route;

//Agregar nota
Route::get('notas/{matricula}/{grupo}', [NotaController::class, 'create'])
    ->name('notas.create');

//Guardar nota
Route::post('notas', [NotaController::class, 'store'])
    ->name('notas.store');

//Reporte de notas
Route::get('notas/{grupo}', [NotaController::class, 'show'])
    ->name('notas.show');

//Editar nota
Route::get('notas/{nota}/{matricula}/{grupo}/editar', [NotaController::class, 'edit'])
    ->name('notas.editar');

//Actualizar nota
Route::put('notas/{nota}', [NotaController::class, 'update'])
    ->name('notas.update');
