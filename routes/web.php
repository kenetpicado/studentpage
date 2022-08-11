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
use App\Http\Controllers\ReporteController;
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

    Route::resource('modulos', ModuloController::class)->except(['create']);
    Route::get('modulos-curso/{id}/crear', [ModuloController::class, 'create'])->name('modulos.create');

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

    Route::put('user-pin', [UserController::class, 'pin'])->name('cambiar.pin');

    Route::get('pagos-alumno/{matricula}', [PagoController::class, 'index'])->name('pagos.index');
    Route::get('pagos-agregar/{matricula}', [PagoController::class, 'create'])->name('pagos.create');
    Route::resource('pagos', PagoController::class)->except(['index', 'create']);

    Route::get('certificado/notas/{inscripcion}', [NotaController::class, 'showCertified'])->name('notas.certified');

    Route::resource('inscripciones', InscripcionController::class)->parameters(['inscripciones' => 'inscripcion'])->except(['create']);
    Route::get('inscribir/{matricula}/{type}', [InscripcionController::class, 'create'])->name('inscripciones.create');

    Route::resource('grupos', GrupoController::class)->except(['index', 'show']);

    Route::resource('matriculas', MatriculaController::class)->only(['show', 'destroy']);

    Route::get('caja', [CajaController::class, 'index'])->name('caja.index');
    Route::post('caja', [CajaController::class, 'buscar'])->name('caja.buscar');

    Route::get('ver-recibo/{pago_id}', [PagoController::class, 'recibo'])->name('recibo');

    Route::get('notificaciones-grupos', [MensajeController::class, 'grupos'])->name('mensajes.grupos');
    Route::get('notificaciones-grupos-agregar', [MensajeController::class, 'agregar'])->name('mensajes.agregar');
    Route::get('notificaciones-grupos-modificar/{id}', [MensajeController::class, 'modificar'])->name('mensajes.modificar');

    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('reportes/promotores/general', [ReporteController::class, 'promotores'])->name('reportes.promotores');
    Route::get('reportes/promotor/{id}', [ReporteController::class, 'promotor'])->name('reportes.promotor');

    Route::get('reportes/docentes/general', [ReporteController::class, 'docentes'])->name('reportes.docentes');
    Route::get('reportes/docente/{id}', [ReporteController::class, 'docente'])->name('reportes.docente');
    Route::get('reportes/grupos/general', [ReporteController::class, 'grupos'])->name('reportes.grupos');
    Route::get('reportes/grupo/{id}', [ReporteController::class, 'grupo'])->name('reportes.grupo');
    
    Route::post('reportes/promotor/rango', [ReporteController::class, 'promotor_rango'])->name('reportes.rango.promotor');
    Route::post('reportes/matriculas/rango', [ReporteController::class, 'matriculas_rango'])->name('reportes.rango.matriculas');

    Route::get('reportes/notas/grupos', [ReporteController::class, 'notas'])->name('reportes.notas');

});

// Autenticado, Administradores y Docente
Route::middleware(['auth', 'admin-docente'])->group(function () {

    Route::get('notas-agregar/{id}', [NotaController::class, 'create'])->name('notas.create');

    Route::get('notas-alumno/{inscripcion}', [NotaController::class, 'index'])->name('notas.index');

    Route::resource('notas', NotaController::class)->except(['index', 'create']);

    Route::resource('grupos', GrupoController::class)
        ->only(['index', 'show']);

    Route::get('mensajes/{grupo_id}', [MensajeController::class, 'index'])->name('mensajes.index');
    Route::resource('mensajes', MensajeController::class)->except(['index', 'show']);
});

//Consulta de estudiantes
Route::middleware(['auth', 'alumno'])->group(function () {
    Route::get('consulta', [ConsultaController::class, 'index'])->name('consulta.index');
    Route::get('consulta/notas/{id}', [ConsultaController::class, 'notas'])->name('consulta.notas');
    Route::get('consulta/mensajes/{id}', [ConsultaController::class, 'mensajes'])->name('consulta.mensajes');
});

//Login
Auth::routes(['register' => false]);

//Autenticado
Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class)->only(['edit', 'update']);
    Route::resource('/', HomeController::class);
});
