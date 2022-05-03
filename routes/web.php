<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\Generate;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PromotorController;
use App\Http\Controllers\HomeController;
use App\Models\Matricula;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Realizar un pago
Route::get('pagos/{matricula}/{grupo}/pagar', [PagoController::class, 'pagar'])->name('pagos.pagar');

//Agregar nota
Route::get('notas/{matricula}/{grupo}/agregar', [NotaController::class, 'agregar'])->name('notas.agregar');

Route::get('notas/{grupo}/reporte', [NotaController::class, 'reporte'])->name('notas.reporte');

//Inscribir a un curso
Route::get('matriculas/{matricula}/inscribir', [MatriculaController::class, 'seleccionar'])->name('matriculas.seleccionar');
Route::put('matriculas/inscribir', [MatriculaController::class, 'inscribir'])->name('matriculas.inscribir');

//Cambiar de grupo
Route::get('grupos/{matricula}/{grupo}/selecionar', [GrupoController::class, 'seleccionar'])->name('grupos.seleccionar');
Route::put('cambiar/{pivot}', [GrupoController::class, 'cambiar'])->name('grupos.cambiar');

//Restablecer pin
Route::post('cambiar/pin', [Generate::class, 'cambiar_pin'])->name('cambiar.pin');

//RUTA PARA PROBAR LAS INTERFACES DE LOS CORREOS
// Route::get('/mailable', function () {
//     return new App\Mail\Restablecimiento('carnebb', 'pinbb');
// });

//RECURSOS
Route::resources([
    'cursos' => CursoController::class,
    'docentes' => DocenteController::class,
    'pagos' => PagoController::class,
    'notas' => NotaController::class,
    'matriculas' => MatriculaController::class,
    'grupos' => GrupoController::class,
    '/' => HomeController::class,
]);

//Recurso particar para establcer la llave promotor
Route::resource('promotores', PromotorController::class)->parameters([
    'promotores' => 'promotor'
]);

//Login
Auth::routes(['register' => false]);

//Ver matricula
Route::get('matriculas/{matricula}/ver', function (Matricula $matricula) {
    return new App\Mail\VerMatricula($matricula);
})->name('matriculas.ver');
