<?php

use App\Http\Controllers\InscripcionController;
use Illuminate\Support\Facades\Route;

//Inscribir a un curso
Route::get('inscripciones/{matricula}/crear', [InscripcionController::class, 'create'])
    ->name('inscripciones.create');

Route::post('inscripciones', [InscripcionController::class, 'store'])
    ->name('inscripciones.store');

//Cambiar de grupo
Route::get('inscripciones/{matricula}/{grupo}/editar', [InscripcionController::class, 'edit'])
    ->name('inscripciones.edit');

Route::put('inscripciones/{inscripcion}', [InscripcionController::class, 'update'])
    ->name('inscripciones.update');
