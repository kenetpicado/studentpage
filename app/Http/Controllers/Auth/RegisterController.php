<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Generate;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:45'],
            'email' => ['required', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //Generar pin
        $pin = Generate::pin();
        
        //Generar el id segun el tipo
        if($data['sucursal'] == 'AD')
        {
            $id = Generate::id('AD', 2);
        }

        if($data['sucursal'] == 'CH')
        {
            $id = Generate::id('CH-AD', 2);
        }

        if($data['sucursal'] == 'MG')
        {
            $id = Generate::id('MG-AD', 2);
        }

        //Enviar id y pin al correo

        //Guardar en los usuarios
        return User::create([
            'name' => $data['name'],
            'correo' => $data['correo'],
            'password' => Hash::make('FFFFFF'),
            'email' => $id,
            'rol' => 'admin',
            'sucursal' => $data['sucursal'],
        ]);
    }
}