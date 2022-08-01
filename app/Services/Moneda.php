<?php

namespace App\Services;

use App\Classes\Items;

class Moneda
{
    public function get()
    {
        $monedas = [];
        array_push($monedas, new Items('CORDOBAS'));
        array_push($monedas, new Items('DOLARES'));
        return $monedas;
    }

}
