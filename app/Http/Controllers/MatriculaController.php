<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Models\Matricula;
use App\Models\Centro;
use App\Models\Grupo;
use App\Models\Prematricula;
use Illuminate\Http\Request;

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
        //MUESTRA FORMULARIO CON TODAS LAS PREMATRICULAS
        //DISPONIBLES PARA HACER UNA MATRICULA
        $prematriculas = Prematricula::has('matricula', '=', '0')->get();
        return view('matricula.create', compact('prematriculas', $prematriculas));
    }

    public function matricular(Prematricula $prematricula)
    {
        $grupos = Grupo::all();
        return view('matricula.realize', compact('prematricula', $prematricula), compact('grupos', $grupos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMatriculaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatriculaRequest $request)
    {

        Matricula::create([
            'carnet' => Generate::idEstudiante('CH04', $request->fecha_nac),
            'pin' => Generate::pin(),
            'manual' => $request->manual,
            'prematricula_id' => $request->prematricula_id,
            'grupo_id' => $request->grupo_id
        ]);

        //MOSTRAR VISTA
        return redirect()->route('matricula.create')->with('info', 'El alumno ha sido matriculado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        //
        $centro = Centro::all()->first();
        return $centro ? view('matricula.show', compact('matricula', $matricula))->with('centro', $centro) : redirect()->route('centro.create');
        //return view('matricula.show', compact('matricula', $matricula))->with('centro', $centro);
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
        return view('matricula.edit', compact('matricula', $matricula));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatriculaRequest  $request
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatriculaRequest $request, Matricula $matricula)
    {
        //
        //return dd($matricula);
        $matricula->update($request->all());
        return redirect()->route('matricula.index')->with('info', 'Se actualizaron los datos!');
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
