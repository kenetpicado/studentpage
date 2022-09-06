<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Models\Curso;
use App\Services\Imagenes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CursoController extends Controller
{
    //Mostrar todos los cursos
    public function index()
    {
        $imagenes = (new Imagenes)->get();
        $cursos = DB::table('cursos')->orderBy('nombre')->paginate(10);
        return view('curso.index', compact('cursos', 'imagenes'));
    }

    //Guardar nuevo curso
    public function store(CursoRequest $request)
    {
        if (Gate::denies('create_curso'))
            return back()->with('error', config('app.denies'));

        Curso::create($request->validated());
        return redirect()->route('cursos.index')->with('success',  config('app.created'));
    }

    //Ver modulos de un curso
    public function show(Curso $curso)
    {
        $modulos = DB::table('modulos')->where('curso_id', $curso->id)->get();
        return view('curso.show', compact('modulos', 'curso'));
    }

    //Mostrar formulario editar curso
    public function edit(Curso $curso)
    {
        $imagenes = (new Imagenes)->get();
        return view('curso.edit', compact('curso', 'imagenes'));
    }

    //Actualizar curso
    public function update(CursoRequest $request, Curso $curso)
    {
        $curso->update($request->validated());
        return redirect()->route('cursos.index')->with('success', config('app.created'));
    }

    //Eliminar curso
    public function destroy(Curso $curso)
    {
        if ($curso->grupos()->count() > 0)
            return redirect()->route('cursos.edit', $curso->id)->with('error', config('app.undeleted'));

        $curso->delete();
        return redirect()->route('cursos.index')->with('success', config('app.deleted'));
    }
}
