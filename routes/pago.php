<?php

use App\Http\Controllers\PagoController;
use Illuminate\Support\Facades\Route;

//Realizar un pago
Route::get('pagos/{matricula}/{grupo}/crear', [PagoController::class, 'create'])
    ->name('pagos.create');

//Guardar nota
Route::post('pagos', [PagoController::class, 'store'])
    ->name('pagos.store');
