<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Models\Docente;
use App\Models\Grupo;
use App\Services\FormattingRequest;
use App\Services\Same;

class DocenteController extends Controller
{
    //Mostrar docentes segun sucursal
    public function index()
    {
        $docentes = auth()->user()->sucursal == 'all'
            ? Docente::getDocentes()
            : Docente::getDocentesSucursal();

        return view('docente.index', compact('docentes'));
    }

    //Guardar docente
    public function store(StoreDocenteRequest $request)
    {
        $formated = (new FormattingRequest)->docente($request);

        $docente = Docente::create($formated->all());
        (new UserController)->store($formated, $docente->id);
        return back()->with('success', 'Guardado');
    }

    //Ver grupos de un docente
    public function show($docente_id)
    {
        $grupos = Grupo::getGruposDocenteShow($docente_id);
        return view('docente.show', compact('grupos'));
    }

    //Formulario para editar un docente
    public function edit(Docente $docente)
    {
        return view('docente.edit', compact('docente'));
    }

    //Actualizar un docente
    public function update(UpdateDocenteRequest $request, Docente $docente)
    {
        if (!$request->activo)
            $request->merge(['activo' => '0']);

        $docente->update($request->all());
        (new UserController)->update($docente);
        return redirect()->route('docentes.index')->with('success', 'Actualizado');
    }

    //Eliminar un docente
    public function destroy(Docente $docente)
    {
        if ($docente->grupos()->count() > 0)
            return redirect()->route('docentes.edit', $docente->id)->with('error', 'No es posible eliminar');

        (new UserController)->destroy($docente->carnet);
        $docente->delete();
        return redirect()->route('docentes.index')->with('success', 'Eliminado');
    }
}
