<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('user.edit');
    }

    public function name(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        User::find(auth()->user()->id)->update(['name' => $request->name]);
        return redirect('/')->with('success', 'Perfil actualizado correctamente');
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|alpha_dash|confirmed'
        ]);

        User::find(auth()->user()->id)->update([
            'password' => bcrypt($request->password),
        ]);
        
        return redirect('/')->with('success', 'Perfil actualizado correctamente');
    }
}
