<?php

use App\Http\Controllers\NotaController;
use Illuminate\Support\Facades\Route;

//Guardar nota
Route::post('notas', [NotaController::class, 'store'])
    ->name('notas.store');

//Actualizar nota
Route::put('notas/{nota}', [NotaController::class, 'update'])
    ->name('notas.update');

//Reporte de notas
Route::get('notas/reporte/{grupo}', [NotaController::class, 'show'])
    ->name('notas.show');

//Certificado de notas
Route::get('certificado/{matricula}/{grupo}', [NotaController::class, 'showCertified'])
    ->name('notas.certified');

//Agregar nota
Route::get('notas/{matricula}/{grupo}/crear', [NotaController::class, 'create'])
    ->name('notas.create');

//Editar nota
Route::get('notas/{nota}/{matricula}/{grupo}/editar', [NotaController::class, 'edit'])
    ->name('notas.editar');
