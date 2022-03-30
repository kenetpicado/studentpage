<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;
use App\Models\Curso;

class CursoController extends Controller
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
        //MOSTRAR FORMULARIO PARA AGREGAR UN NUEVO CURSO
        //ADEMAS MOSTRAR TODOS LOS CURSOS DISPONIBLES DEBAJO
        $cursos = Curso::all();
        return view('curso.create', compact('cursos', $cursos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCursoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCursoRequest $request)
    {
        Curso::create($request->all());
        return redirect()->route('curso.create')->with('info', 'El nuevo curso ha sido agregado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
        return view('curso.destroy', compact('curso', $curso));
    }

    public function verGrupos(Curso $curso)
    {
        return view('curso.grupos', compact('curso', $curso))->with('status', 'Todos los grupos disponibles del curso: ' . $curso->nombre);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        //
        return view('curso.edit', compact('curso', $curso));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCursoRequest  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCursoRequest $request, Curso $curso)
    {
        //
        $curso->update($request->all());
        return redirect()->route('curso.create')->with('info', 'Se ha actualizado el curso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        //
        $curso->delete();
        return redirect()->route('curso.create')->with('info', 'Se ha eliminado el curso!');
    }
}
