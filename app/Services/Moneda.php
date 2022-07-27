<?php

namespace App\Services;

use App\Classes\Items;

class Moneda
{
    public function get()
    {
        $monedas = [];
        array_push($monedas, new Items('CORDOBA'));
        array_push($monedas, new Items('DOLAR'));
        return $monedas;
    }

}
