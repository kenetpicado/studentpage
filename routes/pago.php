<?php

use App\Http\Controllers\PagoController;
use Illuminate\Support\Facades\Route;

//Realizar un pago
Route::get('pagos/{matricula}/{grupo}/pagar', [PagoController::class, 'pagar'])
    ->name('pagos.pagar');

Route::resource('pagos', PagoController::class);
