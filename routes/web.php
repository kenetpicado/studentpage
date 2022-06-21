<?php

use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\Generate;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PromotorController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Autenticado y administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/', HomeController::class);

    Route::resource('cursos', CursoController::class)->except(['show']);

    Route::resource('docentes', DocenteController::class);

    Route::resource('promotores', PromotorController::class)->parameters(['promotores' => 'promotor']);

    Route::put('status/grupos/{grupo}', [GrupoController::class, 'status'])->name('grupos.status');

    Route::get('grupos/terminados', [GrupoController::class, 'showClosed'])->name('grupos.closed');
    Route::get('grupos/terminados/{id}', [GrupoController::class, 'showThisClosed'])->name('grupos.thisClosed');

    //Restablecer pin
    Route::post('cambiar/pin', [Generate::class, 'cambiar_pin'])->name('cambiar.pin');

    Route::get('pagos/{inscripcion}', [PagoController::class, 'index'])->name('pagos.index');
    Route::post('pagos', [PagoController::class, 'store'])->name('pagos.store');

    Route::get('notas/{inscripcion}', [NotaController::class, 'index'])->name('notas.index');
    Route::resource('notas', NotaController::class)->only(['store', 'edit', 'update']);
    Route::get('reporte/notas/{grupo}', [NotaController::class, 'reporte'])->name('notas.reporte');

    Route::resource('inscripciones', InscripcionController::class)
        ->parameters(['inscripciones' => 'inscripcion'])
        ->except(['create']);

    Route::get('inscribir/{matricula}/{type}', [InscripcionController::class, 'create'])->name('inscripciones.create');
});

//Recursos
Route::resource('matriculas', MatriculaController::class)->middleware(['auth']);
Route::resource('grupos', GrupoController::class)->middleware(['auth']);
Route::resource('consulta', ConsultaController::class)->only(['index', 'show']);

//Login
Auth::routes(['register' => false]);
