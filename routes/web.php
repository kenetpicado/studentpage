<?php

use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PromotorController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Autenticado y administradores
Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('cursos', CursoController::class)
        ->except(['create', 'show']);

    Route::resource('docentes', DocenteController::class)
        ->except(['create']);

    Route::resource('promotores', PromotorController::class)
        ->parameters(['promotores' => 'promotor']);

    Route::put('desactivar/grupos/{grupo}', [GrupoController::class, 'desactivarGrupo'])
        ->name('grupos.desactivar');

    Route::put('activar/grupos/{grupo}', [GrupoController::class, 'activarGrupo'])
        ->name('grupos.activar');

    Route::get('grupos/terminados', [GrupoController::class, 'showClosed'])
        ->name('grupos.closed');
    Route::get('grupos/terminados/{id}', [GrupoController::class, 'showThisClosed'])
        ->name('grupos.thisClosed');

    Route::post('cambiar/pin', [UserController::class, 'cambiar_pin'])
        ->name('cambiar.pin');

    Route::get('alumno/pagos/{inscripcion}', [PagoController::class, 'index'])
        ->name('pagos.index');
    Route::resource('pagos', PagoController::class)
        ->except(['index']);

    Route::get('certificado/notas/{inscripcion}', [NotaController::class, 'showCertified'])
        ->name('notas.certified');

    Route::resource('inscripciones', InscripcionController::class)
        ->parameters(['inscripciones' => 'inscripcion'])
        ->except(['create']);

    Route::get('inscribir/{matricula}/{type}', [InscripcionController::class, 'create'])
        ->name('inscripciones.create');

    Route::resource('grupos', GrupoController::class)
        ->except(['index', 'show']);

    Route::resource('matriculas', MatriculaController::class)
        ->only(['show', 'destroy']);
});

// Autenticado, Administradores y Docente
Route::middleware(['auth', 'admin-docente'])->group(function () {

    Route::resource('notas', NotaController::class)
        ->except(['index', 'create']);

    Route::get('alumno/notas/{inscripcion}', [NotaController::class, 'index'])
        ->name('notas.index');

    Route::resource('grupos', GrupoController::class)
        ->only(['index', 'show']);
});

// Autenticado, Administradores y Promotor
Route::resource('matriculas', MatriculaController::class)
    ->except(['show', 'destroy', 'create'])
    ->middleware(['auth', 'admin-promotor']);

//Consulta de estudiantes
Route::resource('consulta', ConsultaController::class)
    ->parameters(['consulta' => 'inscripcion'])
    ->only(['index', 'show'])
    ->middleware(['auth', 'alumno']);

//Login
Auth::routes(['register' => false]);

//Home
Route::resource('/', HomeController::class)->middleware(['auth']);
