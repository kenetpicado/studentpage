<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Traits\ApiTraits;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    use ApiTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Grupo::index(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('docente_autorizado', $id))
            return $this->unauthorized();

        return response()->json(Inscripcion::alumnos($id), 200);
    }

    public function create_nota($grupo_id)
    {
        if (Gate::denies('create_nota'))
            return $this->unauthorized();

        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        $grupo = Grupo::showThis($grupo_id);
        $modulos = DB::table('modulos')->where('curso_id', $grupo->curso_id)->get();

        return response()->json([
            'inscripciones' => $inscripciones,
            'grupo' => $grupo,
            'modulos' => $modulos,
        ], 200);
    }

    public function store_nota(Request $request)
    {
        return $this->success();
    }
}
