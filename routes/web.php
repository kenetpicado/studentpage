<?php

use App\Http\Controllers\CentroController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PrematriculaController;
use App\Http\Controllers\PromotorController;
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

//RUTAS PARTICULARES
Route::get('pago-estudiante/{matricula}', [PagoController::class, 'pagoEstudiante'])->name('pago.estudiante');

//RUTA PARA PROBAR LAS INTERFACES DE LOS CORREOS
// Route::get('/mailable', function () {
//     $invoice = App\Models\Promotor::all()->first();
 
//     return new App\Mail\CredencialesPromotor($invoice);
// });

//RECURSOS DE RUTAS
Route::resource('curso', CursoController::class);
Route::resource('docente', DocenteController::class);
Route::resource('grupo', GrupoController::class);
Route::resource('matricula', MatriculaController::class);
Route::resource('pago', PagoController::class);
Route::resource('prematricula', PrematriculaController::class);
Route::resource('promotor', PromotorController::class);
