<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatriculaRequest;
use App\Models\Matricula;
use App\Models\Centro;
use App\Models\Grupo;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matriculas = Matricula::all();
        return view('matricula.index', compact('matriculas', $matriculas));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos = Grupo::all();
        return view('matricula.create', compact('grupos', $grupos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMatriculaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatriculaRequest $request)
    {
        $request->merge([
            'carnet' =>  Generate::idEstudiante('CH04', $request->fecha_nac), 
            'pin' => Generate::pin()
        ]);
        Matricula::create($request->all());

        //MOSTRAR VISTA
        return redirect()->route('matricula.create')->with('info', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        //SI NO HAY DATOS DEL CENTRO REDIRECCIONA A INGRESAR DICHOS DATOS
        $centro = Centro::all()->first();
        return $centro ? view('matricula.show', compact('matricula', $matricula))->with('centro', $centro) : redirect()->route('centro.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricula $matricula)
    {
        //
        $grupos = Grupo::all();
        return view('matricula.edit', compact('matricula', $matricula), compact('grupos', $grupos));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatriculaRequest  $request
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMatriculaRequest $request, Matricula $matricula)
    {
        //
        $matricula->update($request->all());
        return redirect()->route('matricula.index')->with('info', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matricula $matricula)
    {
        //
    }
}
