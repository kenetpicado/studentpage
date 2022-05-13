<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        //validamos los datos del formulario
        $this->validateLogin($request);

        if(Auth::attempt($request->only('email', 'password'))){
            //si la autenticacion es correcta
            return response()->json([
                'token'=> $request->user()->createToken($request->name)->plainTextToken,
                'message'=> 'Login Successful'
            ]);
        }

        return response()->json([
            'message'=> 'Login Unsuccessful'
        ], 401);	
        
    }

    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required',
            'name' => 'required'
        ]);
    }
}