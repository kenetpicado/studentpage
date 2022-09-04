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

        $promotores = User::promotores();
        return view('permiso.promotor', compact('promotores'));
    }

    public function docentes()
    {
        $docentes = User::docentes();
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
        $create_matricula = array();
        foreach ($request->user_id as $key => $user_id) {
            $this->setPermission($request->create_matricula[$key], $user_id, $create_matricula);
        }

        DB::table('permisos')->whereIn('user_id', $create_matricula)->delete();
        return redirect()->route('promotores.index')->with('success', config('app.updated'));
    }

    public function docente_store(Request $request)
    {
        $create_nota = array();
        $edit_nota = array();
        $create_mensaje = array();

        foreach ($request->user_id as $key => $user_id) {
            $this->setPermission($request->create_nota[$key], $user_id, $create_nota);
            $this->setPermission($request->create_mensaje[$key], $user_id, $create_mensaje);
            $this->setPermission($request->edit_nota[$key], $user_id, $edit_nota);
        }

        DB::table('permisos')->where('denegar', 'create_nota')->whereIn('user_id', $create_nota)->delete();
        DB::table('permisos')->where('denegar', 'edit_nota')->whereIn('user_id', $edit_nota)->delete();
        DB::table('permisos')->where('denegar', 'create_mensaje')->whereIn('user_id', $create_mensaje)->delete();

        return redirect()->route('docentes.index')->with('success', config('app.updated'));
    }

    public function adm_store(Request $request)
    {
        $create_promotor = array();
        $create_docente = array();
        $create_curso = array();
        $create_grupo = array();
        $create_matricula = array();
        $create_mensaje = array();
        $create_nota = array();
        $edit_nota = array();

        foreach ($request->user_id as $key => $user_id) {
            $this->setPermission($request->create_promotor[$key], $user_id, $create_promotor);
            $this->setPermission($request->create_docente[$key], $user_id, $create_docente);
            $this->setPermission($request->create_curso[$key], $user_id, $create_curso);
            $this->setPermission($request->create_grupo[$key], $user_id, $create_grupo);
            $this->setPermission($request->create_matricula[$key], $user_id, $create_matricula);
            $this->setPermission($request->create_mensaje[$key], $user_id, $create_mensaje);
            $this->setPermission($request->create_nota[$key], $user_id, $create_nota);
            $this->setPermission($request->edit_nota[$key], $user_id, $edit_nota);
        }

        DB::table('permisos')->where('denegar', 'create_promotor')->whereIn('user_id', $create_promotor)->delete();
        DB::table('permisos')->where('denegar', 'create_docente')->whereIn('user_id', $create_docente)->delete();
        DB::table('permisos')->where('denegar', 'create_curso')->whereIn('user_id', $create_curso)->delete();
        DB::table('permisos')->where('denegar', 'create_grupo')->whereIn('user_id', $create_grupo)->delete();
        DB::table('permisos')->where('denegar', 'create_matricula')->whereIn('user_id', $create_matricula)->delete();
        DB::table('permisos')->where('denegar', 'create_mensaje')->whereIn('user_id', $create_mensaje)->delete();
        DB::table('permisos')->where('denegar', 'create_nota')->whereIn('user_id', $create_nota)->delete();
        DB::table('permisos')->where('denegar', 'edit_nota')->whereIn('user_id', $edit_nota)->delete();

        return redirect()->route('permisos.adm')->with('success', config('app.updated'));
    }

    public function setPermission($denegar, $user_id, &$users)
    {
        if ($denegar != 0)
            Permiso::updateOrCreate([
                'denegar' => $denegar,
                'user_id' => $user_id,
            ]);
        else
            array_push($users, $user_id);
    }
}
