<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class Generate extends Controller
{
    //PIN de 6 digitos
    public static function pin()
    {
        $comb = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl, 0, 6);
    }

    //ID Promotor / Docente
    public static function id($prefijo, $longitud)
    {
        return $prefijo . '-' . Generate::random_numbers($longitud);
    }

    //Generar ID estudiante
    public static function idEstudiante($prefijo, $fecha)
    {
        $date = Carbon::create($fecha)->format('dmy');
        return $prefijo . "04-" . $date . "-" . Generate::random_numbers(3);
    }

    public function random_numbers($longitud)
    {
        $comb = "0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl, 0, $longitud);
    }
}
