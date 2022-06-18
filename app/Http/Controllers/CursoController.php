<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;
use App\Models\Curso;


class CursoController extends Controller
{
    //Mostrar todos los cursos
    public function index()
    {
        $cursos = Curso::getCursos();
        return view('curso.index', compact('cursos'));
    }

    //Guardar nuevo curso
    public function store(StoreCursoRequest $request)
    {
        Curso::create($request->all());
        return back()->with('info', config('app.add'));
    }

    //Mostrar formulario editar curso
    public function edit($curso_id)
    {
        $curso = Curso::withCount('grupos')->find($curso_id);
        return view('curso.edit', compact('curso'));
    }

    //Actualizar curso
    public function update(UpdateCursoRequest $request, Curso $curso)
    {
        if ($request->activo == null)
            $request->merge(['activo' => '0']);

        $curso->update($request->all());
        return redirect()->route('cursos.index')->with('info', config('app.update'));
    }

    //Eliminar curso
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index')->with('deleted', config('app.deleted'));
    }
}
