<?php

use App\Http\Controllers\AsistenciaController;
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
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/* Usuario autenticado, admin y promotor */

Route::middleware(['auth', 'admin-promotor'])->group(function () {
    Route::resource('matriculas', MatriculaController::class)
        ->except(['destroy', 'show', 'store']);

    Route::post('store/matriculas', [MatriculaController::class, 'store'])
        ->name('matriculas.store');

    Route::post('matriculas', [SearchController::class, 'matriculas'])
        ->name('search.matriculas');
});

// Autenticado y administradores
Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('cursos', CursoController::class)
        ->except(['create']);

    Route::resource('docentes', DocenteController::class)
        ->except(['create']);

    Route::resource('promotores', PromotorController::class)
        ->parameters(['promotores' => 'promotor'])
        ->except(['create']);

    Route::resource('modulos', ModuloController::class)->except(['create']);
    Route::get('modulos-curso/{id}/crear', [ModuloController::class, 'create'])->name('modulos.create');

    Route::put('cambiar-estado-grupo/{grupo}', [GrupoController::class, 'cambiar_estado'])->name('cambiar.estado.grupo');

    Route::put('cambiar-estado-matricula/{matricula}', [MatriculaController::class, 'cambiarEstado'])->name('cambiar.estado');

    Route::get('grupos/terminados', [GrupoController::class, 'index_closed'])->name('grupos.index.closed');
    Route::get('grupos/terminados/{id}', [GrupoController::class, 'show_closed'])->name('grupos.show.closed');

    Route::put('user-pin', [UserController::class, 'pin'])->name('cambiar.pin');

    Route::get('matricula/pagos-alumno/{matricula}', [PagoController::class, 'index'])->name('pagos.index');
    Route::get('matricula/pagos-agregar/{matricula}', [PagoController::class, 'create'])->name('pagos.create');
    Route::resource('matricula/pagos', PagoController::class)->except(['index', 'create']);

    Route::get('certificado/notas/{inscripcion}', [NotaController::class, 'certificado'])->name('notas.certified');

    Route::resource('inscripciones', InscripcionController::class)->parameters(['inscripciones' => 'inscripcion'])->except(['create', 'index']);
    Route::get('inscribir/{matricula}/{type}', [InscripcionController::class, 'create'])->name('inscripciones.create');

    Route::resource('grupos', GrupoController::class)->except(['index', 'show', 'store']);
    Route::post('store/grupos', [GrupoController::class, 'store'])->name('grupos.store');

    Route::resource('matriculas', MatriculaController::class)->only(['show', 'destroy']);

    Route::get('caja', [CajaController::class, 'index'])->name('caja.index');
    Route::post('caja', [CajaController::class, 'buscar'])->name('caja.buscar');

    Route::get('ver-recibo/{pago_id}', [PagoController::class, 'recibo'])->name('recibo');

    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('reportes/promotores', [ReporteController::class, 'promotores'])->name('reportes.promotores');
    Route::get('reportes/promotores/{id}', [ReporteController::class, 'promotor'])->name('reportes.promotor');
    Route::get('reportes/promotores-general', [ReporteController::class, 'promotorGeneral'])->name('reportes.promotorGeneral');
    Route::post('reportes/promotores', [ReporteController::class, 'promotor_rango'])->name('reportes.rango.promotor');

    Route::get('reportes/grupos', [ReporteController::class, 'grupos'])->name('reportes.grupos');
    Route::get('reportes/grupo/{id}', [ReporteController::class, 'grupo'])->name('reportes.grupo');
    Route::post('reportes/matriculas/rango', [ReporteController::class, 'matriculas_rango'])->name('reportes.rango.matriculas');

    Route::get('reportes/pagos/{id}', [ReporteController::class, 'pagos'])->name('reportes.pagos');

    Route::get('permisos/promotores', [PermisoController::class, 'promotores'])->name('permisos.promotores');
    Route::post('permisos/promotores', [PermisoController::class, 'promotor_store'])->name('permisos.promotor.store');

    Route::get('permisos/docentes', [PermisoController::class, 'docentes'])->name('permisos.docentes');
    Route::post('permisos/docentes', [PermisoController::class, 'docente_store'])->name('permisos.docente.store');

    Route::get('permisos/adm', [PermisoController::class, 'adm'])->name('permisos.adm');
    Route::post('permisos/adm', [PermisoController::class, 'adm_store'])->name('permisos.adm.store');
});

// Autenticado, Administradores y Docente
Route::middleware(['auth', 'admin-docente'])->group(function () {

    Route::post('grupos', [SearchController::class, 'grupos'])
        ->name('search.grupos');

    Route::get('grupos/notas-crear/{grupo_id}', [NotaController::class, 'create'])
        ->name('notas.create');

    Route::get('grupos/notas-alumno/{inscripcion}', [NotaController::class, 'index'])->name('notas.index');

    Route::resource('grupos/notas', NotaController::class)
        ->except(['index', 'create', 'update', 'edit']);

    Route::put('notas', [NotaController::class, 'update'])
        ->name('notas.update');

    Route::resource('grupos', GrupoController::class)->only(['index', 'show']);

    Route::get('{type}/mensajes/{grupo_id?}', [MensajeController::class, 'index'])->name('mensajes.index');
    Route::get('{type}/mensajes/{mensaje_id}/editar', [MensajeController::class, 'edit'])->name('mensajes.edit');
    Route::resource('mensajes', MensajeController::class)->only(['store', 'update', 'destroy']);

    Route::get('grupos/asistencias/{grupo_id}', [AsistenciaController::class, 'index'])->name('asistencias.index');
    Route::post('asistencias', [AsistenciaController::class, 'store'])->name('asistencias.store');
    Route::put('asistencias', [AsistenciaController::class, 'update'])->name('asistencias.update');
    Route::get('grupos/asistencias/{grupo_id}/ver', [AsistenciaController::class, 'show'])->name('asistencias.show');
    Route::get('grupos/asistencias/{inscripcion_id}/editar', [AsistenciaController::class, 'edit'])->name('asistencias.edit');
});

//Consulta de estudiantes
Route::middleware(['auth', 'alumno'])->group(function () {
    Route::get('consulta', [ConsultaController::class, 'index'])
        ->name('consulta.index');

    Route::get('consulta/notas/{id}', [ConsultaController::class, 'notas'])
        ->name('consulta.notas');

    Route::get('consulta/mensajes-grupo/{id}', [ConsultaController::class, 'mensajes'])
        ->name('consulta.mensajes');
});

Auth::routes(['register' => false]);

//Autenticado
Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class)->only(['edit', 'update']);
    Route::resource('/', HomeController::class);
});
