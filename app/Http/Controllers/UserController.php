<?php

namespace App\Http\Controllers;

use App\Events\SendCredentialsEvent;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Guardar Usuario
    public function store(Object $request, int $sub_id)
    {
        $pin = $request->pin ?? 'FFFFFF';

        User::create([
            'name' => $request->nombre,
            'email' => $request->carnet,
            'password' => bcrypt($pin),
            'rol' => $request->rol,
            'sucursal' => $request->sucursal,
            'sub_id' => $sub_id,
        ]);

        // if ($request->rol != 'alumno')
        //     event(new SendCredentialsEvent($request, $pin));
    }

    //Actualizar Usuario
    public function update(Object $usuario)
    {
        User::carnet($usuario->carnet)->update(['name' => $usuario->nombre]);
    }

    //Eliminar un usuario
    public function destroy($carnet)
    {
        User::carnet($carnet)->delete();
    }

    //Restablecer PIN
    public function cambiar_pin(Request $request)
    {
        $pin =  Generate::pin();
        User::carnet($request->carnet)->update(['password' => bcrypt('FFFFFF')]);

        //event(new SendCredentialsEvent($request, $pin));
        return redirect()->route($request->tipo . '.index')->with('success', 'Actualizado');
    }
}
