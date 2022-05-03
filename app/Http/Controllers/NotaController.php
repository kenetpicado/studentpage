<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests\UpdateNotaRequest;
use App\Models\Grupo;
use App\Models\Nota;
use App\Models\GrupoMatricula;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    //Agregar nota
    public function agregar($matricula_id, $grupo_id)
    {
        //Obtener el grupo en la tabla pivot
        $pivot = GrupoMatricula::where('grupo_id', $grupo_id)
            ->where('matricula_id', $matricula_id)
            ->with('notas:id,created_at,unidad,valor,grupo_matricula_id')
            ->with('matricula:id,nombre')
            ->withCount('notas')
            ->first('id');

        return view('nota.index', compact('pivot', 'grupo_id'));
    }

    public function reporte($grupo_id)
    {
        $grupo = Grupo::where('id', $grupo_id)
            ->with(['curso:id,nombre', 'docente:id,nombre'])
            ->first(['id', 'horario', 'docente_id', 'curso_id']);

        $pivot = GrupoMatricula::where('grupo_id', $grupo_id)
            ->with('notas:id,unidad,valor,grupo_matricula_id')
            ->with('matricula:id,nombre,carnet')
            ->get();

        $modulos = $pivot->first()->notas;

        return view('nota.reporte', compact('pivot', 'modulos', 'grupo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNotaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotaRequest $request)
    {
        //
        Nota::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(Nota $nota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function edit(Nota $nota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotaRequest  $request
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotaRequest $request, Nota $nota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nota $nota)
    {
        //
    }
}
