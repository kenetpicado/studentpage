<?php

namespace App\Http\Controllers\Api;

use ApiTraits;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //validamos los datos del formulario
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {

            auth()->login($request->user());
            //si la autenticacion es correcta
            return response()->json([
                'status' => '1',
                'token' => $request->user()->createToken($request->email)->plainTextToken,
                'message' => 'Login Successful',
                'email' => $request->user()->email,
                'name' => $request->user()->name,
                'rol' => $request->user()->rol,
                'sucursal' => $request->user()->sucursal,

            ], 200);
        }

        return response()->json([
            'status' => '0',
            'message' => 'Login Unsuccessful'
        ], 401);
    }

    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'message' => 'Logout',
        ], 200);
    }
}
