<?php

namespace App\Services;

use Carbon\Carbon;

class Credenciales
{    
    /**
     * Generar cadena de digitos
     * de longitud $longitud
     *
     * @param  int $longitud
     * @return string
     */
    public function random_numbers($longitud)
    {
        $comb = "0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl, 0, $longitud);
    }
    
    /**
     * Generar un pin de 6 caracteres
     *
     * @return string
     */
    public function pin()
    {
        $comb = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl, 0, 6);
    }
    
    /**
     * Generar Id de Docente y Promotor
     *
     * @param  string $prefijo
     * @param  int $longitud
     * @return string
     */
    public function id($prefijo, $longitud)
    {
        return $prefijo . '-' . $this->random_numbers($longitud);
    }
    
    /**
     * Generar Id de Alumno
     *
     * @param  string $prefijo
     * @param  date $fecha
     * @return string
     */
    public function idEstudiante($prefijo, $fecha)
    {
        $date = Carbon::create($fecha)->format('dmy');
        return $prefijo . "04-" . $date . "-" . $this->random_numbers(3);
    }
}
