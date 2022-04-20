<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PromotorController;
use App\Models\Matricula;
use App\Models\Grupo;
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

Route::get('/', function () {
    return view('blank');
});

//RUTAS PARTICULARES
Route::get('pago-estudiante/{matricula}', [PagoController::class, 'pagoEstudiante'])->name('pago.estudiante');

Route::get('inscribir/{matricula}', function (Matricula $matricula) {
    //Obtener los cursos segun la sucursal de la matricula
    $grupos = Grupo::where('sucursal', $matricula->sucursal)->get();
    return view('matricula.inscribir', compact('matricula', 'grupos'));
})->name('matricula.inscribir');

//RUTA PARA PROBAR LAS INTERFACES DE LOS CORREOS
// Route::get('/mailable', function () {
//     return new App\Mail\Restablecimiento('carnebb', 'pinbb');
// });

//RECURSOS DE RUTAS
Route::resource('curso', CursoController::class);
Route::resource('docente', DocenteController::class);
Route::resource('grupo', GrupoController::class);
Route::resource('matricula', MatriculaController::class);
Route::resource('pago', PagoController::class);
Route::resource('promotor', PromotorController::class);
Auth::routes(['register' => false]);
//Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
