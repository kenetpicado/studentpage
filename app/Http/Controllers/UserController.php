<?php

namespace App\Http\Controllers;

use App\Events\SendCredentialsEvent;
use App\Models\User;
use App\Services\Credenciales;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Guardar Usuario
    public function store(Request $request)
    {

    }

    public function update(Request $request, User $user)
    {

    }

    //Eliminar un usuario
    public function destroy(User $user)
    {

    }

    //Restablecer PIN
    public function cambiar_pin(Request $request)
    {
        $pin = (new Credenciales)->pin();
        User::carnet($request->carnet)->update(['password' => bcrypt('FFFFFF')]);

        //event(new SendCredentialsEvent($request, $pin));
        return redirect()->route($request->tipo . '.index')->with('success', 'Actualizado');
    }
}
