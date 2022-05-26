<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\Restablecimiento;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Generate extends Controller
{
    //Generar un PIN de 6 digitos
    public static function pin()
    {
        $comb = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl, 0, 6);
    }

    //Funcion para restablecer pin
    public function cambiar_pin(Request $request)
    {
        $user = User::where('email', $request->carnet)->first(['id', 'password']);
        $pin =  $this->pin();

        $user->update(['password' => Hash::make('FFFFFF')]);

        //Enviar correo con nuevo pin
        //Mail::to($request->correo)->send(new Restablecimiento($request->carnet, $pin));

        return redirect()->route($request->tipo . '.index')->with('info', 'ok');
    }

    //Funcion para generar un ID segun sucursal
    public static function id($location, $cant)
    {
        return $location . Generate::specific_number($cant);
    }

    public static function idEstudiante($location, $fecha)
    {
        //1998-05-26
        //260598
        $dia = $fecha[8] . $fecha[9];
        $mes = $fecha[5] . $fecha[6];
        $anyo = $fecha[2] . $fecha[3];
        return $location . "-" . $dia . $mes . $anyo . "-" . Generate::specific_number(3);
    }

    //Funcion para devolver una secuencia de numeros
    //aleatoria de una longitud especifica
    public function specific_number($long)
    {
        $comb = "0123456789";
        $shfl = str_shuffle($comb);
        return substr($shfl, 0, $long);
    }
}
