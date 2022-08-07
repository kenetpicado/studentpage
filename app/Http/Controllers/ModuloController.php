<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuloRequest;
use App\Models\Modulo;

class ModuloController extends Controller
{
    //Guardar nuevo modulo
    public function store(ModuloRequest $request)
    {
        Modulo::create($request->validated());
        return redirect()->route('cursos.show', $request->curso_id)->with('success', config('app.created'));
    }

    //Agregar moduilo de un curso
    public function create($curso_id)
    {
        return view('modulo.create', compact('curso_id'));
    }

    //Editar un modulo
    public function edit(Modulo $modulo)
    {
        return view('modulo.edit', compact('modulo'));
    }

    //Actualizar un modulo
    public function update(ModuloRequest $request, Modulo $modulo)
    {
        $modulo->update($request->validated());
        return redirect()->route('cursos.show', $modulo->curso_id)->with('success', config('app.updated'));
    }

    public function destroy(Modulo $modulo)
    {
        if ($modulo->notas()->count() > 0)
            return redirect()->route('modulos.edit', $modulo->id)->with('error', config('app.undeleted'));

        $modulo->delete();
        return redirect()->route('cursos.show', $modulo->curso_id)->with('success', config('app.deleted'));
    }
}
