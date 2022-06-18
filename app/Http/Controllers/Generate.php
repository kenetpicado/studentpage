<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\Restablecimiento;
use Carbon\Carbon;
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

        return redirect()->route($request->tipo . '.index');
    }

    //Funcion para generar un ID segun sucursal
    public static function id($location, $cant)
    {
        return $location . '-' . Generate::specific_number($cant);
    }

    public static function idEstudiante($location, $fecha)
    {
        $date = Carbon::create($fecha)->format('dmy');
        return $location . "04-" . $date . "-" . Generate::specific_number(3);
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
