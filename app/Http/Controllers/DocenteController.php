<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Docente;
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
        Docente::create($request->validated());
        return redirect()->route('docentes.index')->with('success', config('app.created'));
    }

    //Ver grupos de un docente
    public function show($docente_id)
    {
        $grupos = Grupo::docente($docente_id);
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
        $docente->update($request->validated());
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
