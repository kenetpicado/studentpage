<?php

namespace App\Http\Controllers;

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

        //Aqui deberia enviar correo
        //Mail::to($request->correo)->send(new CredencialesDocente($docente, $pin));
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
        $user = User::carnet($request->carnet);
        $pin =  Generate::pin();

        $user->update(['password' => bcrypt('FFFFFF')]);

        //Enviar correo con nuevo pin
        //Mail::to($request->correo)->send(new Restablecimiento($request->carnet, $pin));

        return redirect()->route($request->tipo . '.index')->with('success', 'Actualizado');
    }
}
