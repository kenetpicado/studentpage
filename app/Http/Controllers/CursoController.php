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
        return redirect()->route('curso.create')->with('info', 'ok');
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
    }

    public function verGrupos(Curso $curso)
    {
        return view('curso.grupos', compact('curso', $curso))->with('status', 'Todos los grupos disponibles del curso: ' . $curso->nombre);
    }
    public function estado(Curso $curso)
    {
        $nuevo_estado = ($curso->estado == '0') ? '1' : '0';
        $curso->update(['estado'=>$nuevo_estado]);
        return redirect()->route('curso.create')->with('info', 'ok');
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
    public function update(StoreCursoRequest $request, Curso $curso)
    {
        //
        $curso->update($request->all());
        return redirect()->route('curso.create')->with('info', 'ok');
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
        return redirect()->route('curso.create')->with('info', 'eliminado');
    }
}
