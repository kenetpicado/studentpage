<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PromotorController;
use App\Models\Matricula;
use App\Models\Grupo;
use App\Models\GrupoMatricula;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Nota;

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

Route::get('/', function () {
    return view('blank');
});

//Realizar un pago
Route::get('pagar/{matricula}/{grupo}', [PagoController::class, 'pagar'])->name('pagar');

//Inscribir a un curso
Route::get('inscribir/{matricula}', [MatriculaController::class, 'inscribir'])->name('matricula.inscribir');

//Agregar nota
Route::get('nota-agregar/{matricula}/{grupo}', [NotaController::class, 'agregar'])->name('nota.agregar');

//RUTA PARA PROBAR LAS INTERFACES DE LOS CORREOS
// Route::get('/mailable', function () {
//     return new App\Mail\Restablecimiento('carnebb', 'pinbb');
// });

//Ver matricula
Route::get('matricula-ver/{matricula}', function (Matricula $matricula) {
    return new App\Mail\VerMatricula($matricula);
})->name('matricula.ver');

//RECURSOS DE RUTAS
Route::resource('curso', CursoController::class);
Route::resource('docente', DocenteController::class);
Route::resource('grupo', GrupoController::class);
Route::resource('matricula', MatriculaController::class);
Route::resource('pago', PagoController::class);
Route::resource('promotor', PromotorController::class);
Route::resource('nota', NotaController::class);
Auth::routes(['register' => false]);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
