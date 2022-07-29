<?php

namespace App\Services;

use Carbon\Carbon;

class Credenciales
{
    public function random_numbers($longitud)
    {
        $comb = "0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl, 0, $longitud);
    }

    public function pin()
    {
        $comb = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl, 0, 6);
    }

    //ID Promotor / Docente
    public function id($prefijo, $longitud)
    {
        return $prefijo . '-' . $this->random_numbers($longitud);
    }

    public function idEstudiante($prefijo, $fecha)
    {
        $date = Carbon::create($fecha)->format('dmy');
        return $prefijo . "04-" . $date . "-" . $this->random_numbers(3);
    }


}
