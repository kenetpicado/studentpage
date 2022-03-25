<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Generate extends Controller
{
    //Funcion para generar un PIN de 6 digitos
    static function pin(){
        return Generate::specific(6);
    }

    //Funcion para generar un ID
    static function id($location) 
    {
        return $location . "-" . Generate::specific_number(6) . "-" . Generate::specific_number(3);
    }

    static function idEstudiante($location, $fecha)
    {
        //1998-05-26
        //260598
        $dia = $fecha[8].$fecha[9];
        $mes = $fecha[5].$fecha[6];
        $anyo = $fecha[2].$fecha[3];
        return $location ."-" . $dia . $mes . $anyo . "-" . Generate::specific_number(3);
    }

    //Funcion para devolver una secuencia
    //aleatoria de una longitud especifica
    public function specific($long)
    {
        $comb = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl,0,$long);
    }

    //Funcion para devolver una secuencia de numeros
    //aleatoria de una longitud especifica
    public function specific_number($long)
    {
        $comb = "0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl,0,$long);
    }

}
