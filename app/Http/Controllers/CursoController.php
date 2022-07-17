<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Models\Curso;


class CursoController extends Controller
{
    //Mostrar todos los cursos
    public function index()
    {
        $imagenes = $this->listarImagenes();
        $cursos = Curso::getCursos();
        return view('curso.index', compact('cursos', 'imagenes'));
    }

    //Guardar nuevo curso
    public function store(CursoRequest $request)
    {
        Curso::create($request->all());
        return back()->with('success', 'Guardado');
    }

    //Mostrar formulario editar curso
    public function edit(Curso $curso)
    {
        $imagenes = $this->listarImagenes();
        return view('curso.edit', compact('curso', 'imagenes'));
    }

    //Actualizar curso
    public function update(CursoRequest $request, Curso $curso)
    {
        if (!$request->activo)
            $request->merge(['activo' => '0']);

        $curso->update($request->all());
        return redirect()->route('cursos.index')->with('success', 'Actualizado');
    }

    //Eliminar curso
    public function destroy(Curso $curso)
    {
        if ($curso->grupos()->count() > 0)
            return redirect()->route('cursos.edit', $curso->id)->with('error', 'No es posible eliminar');

        $curso->delete();
        return redirect()->route('cursos.index')->with('success', 'Eliminado');
    }

    public function listarImagenes()
    {
        $imagenes = [];
        $path = '../public/courses';
        $dir = opendir($path);

        while ($elemento = readdir($dir)) {
            if (!in_array($elemento, ['.', '..']))
                array_push($imagenes, ['nombre' => $elemento]);
        }
        closedir($dir);
        return collect($imagenes)->sortBy('nombre');
    }
}
