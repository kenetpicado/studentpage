<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\Grupo;
use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Validation\Rule;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cursos = Curso::all();
        $docentes = Docente::all();
        $grupos = Grupo::all();

        return view('grupo.index',compact('grupos', 'cursos', 'docentes'))->with('status', 'Todos los cursos y grupos registrados');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGrupoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrupoRequest $request)
    {
        //  OBTENER DATOS PARA VALIDAR
        $curso_id = $request->curso_id;
        $curso = Curso::find($curso_id);

        //VALIRDAR QUE NO HAYA OTRO GRUPO DEL MISMO CURSO
        $request->validate(
            [
                'numero' => Rule::unique('grupos')->where(function ($query) use ($curso_id) {
                    return $query->where('curso_id', $curso_id);
                }),
            ],
            [
                'numero.unique' => 'Ya existe un ' . $request->numero . ' del curso ' . $curso->nombre
            ]
        );

        Grupo::create($request->all());
        return redirect()->route('grupo.index')->with('info', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
    }
    public function verAlumnos(Grupo $grupo)
    {
        return view('grupo.alumnos', compact('grupo', $grupo));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {
        //
        $docentes = Docente::all();
        return view('grupo.edit', compact('grupo', $grupo), compact('docentes', $docentes));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGrupoRequest  $request
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGrupoRequest $request, Grupo $grupo)
    {
        //
        $grupo->update($request->all());
        return redirect()->route('grupo.index')->with('info', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        //
    }
}
