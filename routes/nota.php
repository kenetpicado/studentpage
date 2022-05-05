<?php

use App\Http\Controllers\NotaController;
use Illuminate\Support\Facades\Route;

//Agregar nota
Route::get('notas/{matricula}/{grupo}/agregar', [NotaController::class, 'agregar'])
    ->name('notas.agregar');

//Reporte de notas
Route::get('notas/{grupo}/reporte', [NotaController::class, 'reporte'])
    ->name('notas.reporte');

Route::get('notas/{nota}/{matricula}/{grupo}/editar', [NotaController::class, 'edit'])
    ->name('notas.editar');

Route::resource('notas', NotaController::class);
