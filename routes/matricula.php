<?php

use App\Http\Controllers\MatriculaController;
use Illuminate\Support\Facades\Route;

//Inscribir a un curso
Route::get('matriculas/{matricula}/inscribir', [MatriculaController::class, 'seleccionar'])
    ->name('matriculas.seleccionar');

Route::put('matriculas/inscribir', [MatriculaController::class, 'inscribir'])
    ->name('matriculas.inscribir');

Route::resource('matriculas', MatriculaController::class);
