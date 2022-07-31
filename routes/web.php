<?php

use App\Http\Controllers\CajaController;
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
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Autenticado, Administradores y Promotor
Route::resource('matriculas', MatriculaController::class)
    ->except(['destroy', 'show'])
    ->middleware(['auth', 'admin-promotor']);

// Autenticado y administradores
Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('cursos', CursoController::class);
    Route::resource('modulos', ModuloController::class);
    Route::resource('docentes', DocenteController::class);

    Route::resource('promotores', PromotorController::class)->parameters(['promotores' => 'promotor']);

    Route::put('desactivar/grupos/{grupo}', [GrupoController::class, 'desactivarGrupo'])
        ->name('grupos.desactivar');

    Route::put('activar/grupos/{grupo}', [GrupoController::class, 'activarGrupo'])
        ->name('grupos.activar');

    Route::put('cambiar-estado/{matricula}', [MatriculaController::class, 'cambiarEstado'])->name('cambiar.estado');

    Route::get('grupos/terminados', [GrupoController::class, 'showClosed'])
        ->name('grupos.closed');
    Route::get('grupos/terminados/{id}', [GrupoController::class, 'showThisClosed'])
        ->name('grupos.thisClosed');

    Route::put('cambiar/pin', [UserController::class, 'cambiar_pin'])->name('cambiar.pin');

    Route::get('pagos-alumno/{matricula}', [PagoController::class, 'index'])->name('pagos.index');
    Route::get('pagos-agregar/{matricula}', [PagoController::class, 'create'])->name('pagos.create');
    Route::resource('pagos', PagoController::class)->except(['index', 'create']);

    Route::get('certificado/notas/{inscripcion}', [NotaController::class, 'showCertified'])
        ->name('notas.certified');

    Route::resource('inscripciones', InscripcionController::class)
        ->parameters(['inscripciones' => 'inscripcion'])
        ->except(['create']);

    Route::get('inscribir/{matricula}/{type}', [InscripcionController::class, 'create'])
        ->name('inscripciones.create');

    Route::resource('grupos', GrupoController::class)->except(['index', 'show']);

    Route::resource('matriculas', MatriculaController::class)
        ->only(['show', 'destroy']);

    Route::get('caja', [CajaController::class, 'index'])->name('caja.index');
    Route::post('caja', [CajaController::class, 'buscar'])->name('caja.buscar');
});

// Autenticado, Administradores y Docente
Route::middleware(['auth', 'admin-docente'])->group(function () {

    Route::get('notas-agregar/{id}', [NotaController::class, 'create'])->name('notas.create');

    Route::get('notas-alumno/{inscripcion}', [NotaController::class, 'index'])->name('notas.index');

    Route::resource('notas', NotaController::class)->except(['index', 'create']);

    Route::resource('grupos', GrupoController::class)
        ->only(['index', 'show']);

    Route::get('mensajes/{grupo_id}', [MensajeController::class, 'index'])->name('mensajes.index');
    Route::resource('mensajes', MensajeController::class)->except(['index', 'show', 'create']);
});

//Consulta de estudiantes
Route::middleware(['auth', 'alumno'])->group(function () {
    Route::get('consulta', [ConsultaController::class, 'index'])->name('consulta.index');
    Route::get('consulta/notas/{id}', [ConsultaController::class, 'notas'])->name('consulta.notas');
    Route::get('consulta/mensajes/{id}', [ConsultaController::class, 'mensajes'])->name('consulta.mensajes');
});

//Login
Auth::routes(['register' => false]);

//Home
Route::resource('/', HomeController::class)->middleware(['auth']);