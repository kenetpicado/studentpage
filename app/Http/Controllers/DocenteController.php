<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Docente;
use App\Services\FormattingRequest;
use App\Http\Requests\DocenteRequest;

class DocenteController extends Controller
{
    //Mostrar docentes
    public function index()
    {
        $docentes = Docente::index();
        return view('docente.index', compact('docentes'));
    }

    //Agregar nuevo docente
    public function create()
    {
        return view('docente.create');
    }

    //Guardar docente
    public function store(DocenteRequest $request)
    {
        $formated = (new FormattingRequest)->docente($request);
        Docente::create($formated->all());
        return redirect()->route('docentes.index')->with('success', config('app.created'));
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
    public function update(DocenteRequest $request, Docente $docente)
    {
        if (!$request->activo)
            $request->merge(['activo' => '0']);

        $docente->update($request->all());
        return redirect()->route('docentes.index')->with('success', config('app.updated'));
    }

    //Eliminar un docente
    public function destroy(Docente $docente)
    {
        if ($docente->grupos()->count() > 0)
            return redirect()->route('docentes.edit', $docente->id)->with('error', config('app.undeleted'));

        $docente->delete();
        return redirect()->route('docentes.index')->with('success', config('app.deleted'));
    }
}
