<?php

namespace App\Http\Controllers;

use App\Events\SendCredentialsEvent;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Credenciales;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Editar usuario
    public function edit(User $user)
    {
        if ($user->id != auth()->user()->id)
            abort(403);

        return view('user.edit', compact('user'));
    }

    //Actualizar usuario
    public function update(UserRequest $request, User $user)
    {
        if ($user->id != auth()->user()->id)
            abort(403);

        if ($request->password)
            $request->merge(['password' => bcrypt($request->password)]);

        $user->update($request->validated());
        return redirect()->route('index')->with('success', config('app.updated'));
    }

    //Restablecer PIN
    public function pin(Request $request)
    {
        $pin = (new Credenciales)->pin();
        User::where('email', $request->carnet)->first()->update(['password' => bcrypt('FFFFFF')]);

        //event(new SendCredentialsEvent($request, $pin));
        return redirect()->route($request->tipo . '.index')->with('success', config('app.updated'));
    }
}
