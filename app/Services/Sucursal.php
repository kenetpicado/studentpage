<?php

namespace App\Services;

use App\Classes\Items;

class Sucursal
{
    public function get()
    {
        $sucursales = [];
        array_push($sucursales, new Items('CHINANDENGA', 'CH'));
        array_push($sucursales, new Items('MANAGUA', 'MG'));
        return $sucursales;
    }

}
