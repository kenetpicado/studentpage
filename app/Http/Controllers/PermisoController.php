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
            ? User::with('permisos')->where('rol', 'docente')->where('sucursal', auth()->user()->sucursal)->get()
            : User::with('permisos')->where('rol', 'docente')->get();

        return view('permiso.docente', compact('docentes'));
    }

    public function adm()
    {
        if (auth()->user()->sucursal != 'all')
            return back()->with('error', config('app.denies'));

        $adms = User::with('permisos')->where('rol', 'admin')->where('sucursal', '!=', 'all')->get();
        return view('permiso.adm', compact('adms'));
    }

    public function promotor_store(Request $request)
    {
        $ids_delete = array();
        foreach ($request->user_id as $key => $user_id) {
            $this->setPermission($request->permitir_matricula, $key, $ids_delete, $user_id, 'matricula');
        }

        DB::table('permisos')->whereIn('user_id', $ids_delete)->delete();
        return redirect()->route('promotores.index')->with('success', config('app.updated'));
    }

    public function docente_store(Request $request)
    {
        $ids_nota = array();
        $ids_mensaje = array();

        foreach ($request->user_id as $key => $user_id) {
            $this->setPermission($request->permitir_nota, $key, $ids_nota, $user_id, 'nota');
            $this->setPermission($request->permitir_mensaje, $key, $ids_mensaje, $user_id, 'mensaje');
        }

        DB::table('permisos')->where('denegar', 'create_nota')->whereIn('user_id', $ids_nota)->delete();
        DB::table('permisos')->where('denegar', 'create_mensaje')->whereIn('user_id', $ids_mensaje)->delete();

        return redirect()->route('docentes.index')->with('success', config('app.updated'));
    }

    public function adm_store(Request $request)
    {
        $ids_promotor = array();
        $ids_docente = array();
        $ids_curso = array();
        $ids_grupo = array();
        $ids_matricula = array();
        $ids_mensaje = array();

        foreach ($request->user_id as $key => $user_id) {
            $this->setPermission($request->permitir_promotor, $key, $ids_promotor, $user_id, 'promotor');
            $this->setPermission($request->permitir_docente, $key, $ids_docente, $user_id, 'docente');
            $this->setPermission($request->permitir_curso, $key, $ids_curso, $user_id, 'curso');
            $this->setPermission($request->permitir_grupo, $key, $ids_grupo, $user_id, 'grupo');
            $this->setPermission($request->permitir_matricula, $key, $ids_matricula, $user_id, 'matricula');
            $this->setPermission($request->permitir_mensaje, $key, $ids_mensaje, $user_id, 'mensaje');
        }

        DB::table('permisos')->where('denegar', 'create_promotor')->whereIn('user_id', $ids_promotor)->delete();
        DB::table('permisos')->where('denegar', 'create_docente')->whereIn('user_id', $ids_docente)->delete();
        DB::table('permisos')->where('denegar', 'create_curso')->whereIn('user_id', $ids_curso)->delete();
        DB::table('permisos')->where('denegar', 'create_grupo')->whereIn('user_id', $ids_grupo)->delete();
        DB::table('permisos')->where('denegar', 'create_matricula')->whereIn('user_id', $ids_matricula)->delete();
        DB::table('permisos')->where('denegar', 'create_mensaje')->whereIn('user_id', $ids_mensaje)->delete();

        return redirect()->route('permisos.adm')->with('success', config('app.updated'));
    }

    public function setPermission($permitir, $key, &$ids, $user_id, $model)
    {
        if ($permitir[$key] == 1)
            array_push($ids, $user_id);
        else
            Permiso::updateOrCreate([
                'denegar' => 'create_' . $model,
                'user_id' => $user_id,
            ]);
    }
}
