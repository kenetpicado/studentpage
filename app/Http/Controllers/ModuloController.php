<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuloRequest;
use App\Models\Modulo;

class ModuloController extends Controller
{
    //Guardar nuevo modulo
    public function store(ModuloRequest $request)
    {
        Modulo::create($request->all());
        return redirect()->route('cursos.show', $request->curso_id)->with('success', 'Modulo agregado correctamente');
    }

    //Editar un modulo
    public function edit(Modulo $modulo)
    {
        return view('modulo.edit', compact('modulo'));
    }

    //Actualizar un modulo
    public function update(ModuloRequest $request, Modulo $modulo)
    {
        $modulo->update($request->all());
        return redirect()->route('cursos.show', $modulo->curso_id)->with('success', 'Modulo actualizado correctamente');
    }

    public function destroy(Modulo $modulo)
    {
        if ($modulo->notas()->count() > 0)
            return redirect()->route('modulos.edit', $modulo->id)->with('error', 'No es posible eliminar');

        $modulo->delete();
        return redirect()->route('cursos.show', $modulo->curso_id)->with('success', 'Eliminado');
    }
}
