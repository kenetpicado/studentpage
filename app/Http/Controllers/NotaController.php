<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests\UpdateNotaRequest;
use App\Models\Nota;
use App\Models\Matricula;
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
        //Obtener el estudiante
        $matricula = Matricula::find($matricula_id, ['id', 'nombre']);

        //Obtener el grupo en la tabla pivot
        $pivot = GrupoMatricula::where('grupo_id', $grupo_id)->where('matricula_id', $matricula->id)->first('id');

        //Obtener las notas
        $notas = Nota::where('grupo_matricula_id', $pivot->id)->get(['id', 'created_at', 'unidad', 'valor']);
        return view('nota.index', compact('matricula', 'pivot', 'notas', 'grupo_id'));
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
