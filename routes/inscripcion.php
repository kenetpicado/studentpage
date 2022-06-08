<?php

use App\Http\Controllers\InscripcionController;
use Illuminate\Support\Facades\Route;

//Inscribir a un curso
Route::get('inscripciones/{matricula}/{type}', [InscripcionController::class, 'create'])
    ->name('inscripciones.create');

//Cambiar de grupo
Route::get('inscripciones/{matricula}/{grupo}/editar', [InscripcionController::class, 'edit'])
    ->name('inscripciones.edit');

Route::resource('inscripciones', InscripcionController::class)
    ->parameters(['inscripciones' => 'inscripcion'])
    ->only(['store', 'update', 'destroy']);
