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
        if (auth()->user()->sucursal != 'all')
            return back()->with('error', config('app.denies'));

        $promotores = User::with('permisos')->where('rol', 'promotor')->get();
        return view('permiso.promotor', compact('promotores'));
    }

    public function docentes()
    {
        $docentes = auth()->user()->sucursal != 'all'
            ?  User::with('permisos')->where('rol', 'docente')->where('sucursal', auth()->user()->sucursal)->get()
            : User::with('permisos')->where('rol', 'docente')->get();

        return view('permiso.docente', compact('docentes'));
    }

    public function promotor_store(Request $request)
    {
        $ids_delete = array();
        foreach ($request->user_id as $key => $user_id) {

            if ($request->permitir[$key] == 1)
                array_push($ids_delete, $user_id);
            else
                Permiso::updateOrCreate([
                    'user_id' => $user_id,
                    'denegar' => 'create_matricula'
                ]);
        }

        DB::table('permisos')->whereIn('user_id', $ids_delete)->delete();
        return redirect()->route('promotores.index')->with('success', config('app.updated'));
    }

    public function docente_store(Request $request)
    {
        $ids_nota = array();
        $ids_mensaje = array();

        foreach ($request->user_id as $key => $user_id) {

            if ($request->permitir_nota[$key] == 1)
                array_push($ids_nota, $user_id);
            else
                Permiso::updateOrCreate([
                    'denegar' => 'create_nota',
                    'user_id' => $user_id,
                ]);

            if ($request->permitir_mensaje[$key] == 1)
                array_push($ids_mensaje, $user_id);
            else
                Permiso::updateOrCreate([
                    'denegar' => 'create_mensaje',
                    'user_id' => $user_id,
                ]);
        }

        DB::table('permisos')->where('denegar', 'create_nota')->whereIn('user_id', $ids_nota)->delete();
        DB::table('permisos')->where('denegar', 'create_mensaje')->whereIn('user_id', $ids_mensaje)->delete();

        return redirect()->route('docentes.index')->with('success', config('app.updated'));
    }
}
