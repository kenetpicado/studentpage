<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests\UpdateNotaRequest;
use App\Models\Grupo;
use App\Models\Nota;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NotaController extends Controller
{
    //Ver notas
    public function index(Inscripcion $inscripcion)
    {
        Gate::authorize('admin-docente');
        $inscripcion->load('notas');
        return view('nota.index', compact('inscripcion'));
    }

    //Guardar nota
    public function store(StoreNotaRequest $request)
    {
        Gate::authorize('admin-docente');
        Nota::create($request->all());
        return back()->with('info', config('app.add'));
    }

    //Editar nota
    public function edit(Nota $nota)
    {
        Gate::authorize('admin-docente');
        $nota->load('inscripcion');
        return view('nota.edit', compact('nota'));
    }

    //Actualizar nota
    public function update(UpdateNotaRequest $request, Nota $nota)
    {
        Gate::authorize('admin-docente');
        $nota->update($request->all());
        return redirect()->route('notas.index', $nota->inscripcion_id)->with('info', config('app.update'));
    }

    //Eliminar una nota
    public function destroy(Request $request, Nota $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index', $request->inscripcion)->with('deleted', config('app.deleted'));
    }

    //Ver reporte de notas
    public function show($grupo_id)
    {
        Gate::authorize('admin-docente');
        $grupo = Grupo::getToReport($grupo_id);
        $inscripciones = Inscripcion::getToReport($grupo_id);
        return view('nota.show', compact('inscripciones', 'grupo'));
    }

    //Ver certificado de notas
    public function showCertified(Inscripcion $inscripcion)
    {
        Gate::authorize('admin');
        $inscripcion->load('notas');
        return view('nota.certified', compact('inscripcion'));
    }


}
