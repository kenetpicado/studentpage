<?php

use App\Http\Controllers\CentroController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\PrematriculaController;
use App\Http\Controllers\PromotorController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PagoController;
use Illuminate\Support\Facades\Route;

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

Route::get('pagar/{matricula}', [PagoController::class, 'pagar'])->name('pagar');
Route::get('matricular/{prematricula}', [MatriculaController::class, 'matricular'])->name('matricular');
Route::get('prematricula-activa', [PrematriculaController::class, 'active'])->name('prematricula.activa');
Route::get('prematricula-inactiva', [PrematriculaController::class, 'inactive'])->name('prematricula.inactiva');


Route::resource('prematricula', PrematriculaController::class);
Route::resource('matricula', MatriculaController::class);
Route::resource('promotor', PromotorController::class);
Route::resource('pago', PagoController::class);
Route::resource('curso', CursoController::class);
Route::resource('docente', DocenteController::class);
Route::resource('centro', CentroController::class);
