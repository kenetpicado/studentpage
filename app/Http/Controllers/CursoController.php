<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;
use App\Models\Curso;
use Illuminate\Support\Facades\Gate;


class CursoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Mostrar todos los cursos
    public function index()
    {
        Gate::authorize('admin');
        $cursos = Curso::getCursos();
        return view('curso.index', compact('cursos'));
    }

    //Guardar nuevo curso
    public function store(StoreCursoRequest $request)
    {
        Gate::authorize('admin');
        Curso::create($request->all());
        return back()->with('info', config('app.add'));
    }

    //Mostrar formulario editar curso
    public function edit($curso_id)
    {
        Gate::authorize('admin');
        $curso = Curso::withCount('grupos')->find($curso_id);
        return view('curso.edit', compact('curso'));
    }

    //Actualizar curso
    public function update(UpdateCursoRequest $request, Curso $curso)
    {
        Gate::authorize('admin');
        
        if ($request->activo == null)
            $request->merge(['activo' => '0']);

        $curso->update($request->all());
        return redirect()->route('cursos.index')->with('info', config('app.update'));
    }

    //Eliminar curso
    public function destroy(Curso $curso)
    {
        Gate::authorize('admin');
        $curso->delete();
        return redirect()->route('cursos.index')->with('deleted', config('app.deleted'));
    }
}
