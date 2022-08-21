<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{
    public function promotores()
    {
        $promotores = User::with('permisos')->where('rol', 'promotor')->get();
        return view('permiso.promotor', compact('promotores'));
    }

    public function promotor_store(Request $request)
    {
        $ids_delete = array();
        foreach ($request->user_id as $key => $user_id) {

            if ($request->permitir[$key] == 1)
                array_push($ids_delete, $user_id);
            else
                Permiso::create([
                    'denegar' => 'create_matricula',
                    'user_id' => $user_id,
                ]);
        }

        DB::table('permisos')->whereIn('user_id', $ids_delete)->delete();
        return redirect()->route('promotores.index')->with('success', config('app.updated'));
    }
}
