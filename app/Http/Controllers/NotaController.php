<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests\UpdateNotaRequest;
use App\Models\Grupo;
use App\Models\Nota;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Gate;

class NotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Agregar nota
    public function agregar($matricula_id, $grupo_id)
    {
        Gate::authorize('admin-docente');
        $inscripcion = Inscripcion::loadWithNotas($grupo_id, $matricula_id);
        return view('nota.index', compact('inscripcion', 'grupo_id'));
    }

    public function reporte($grupo_id)
    {
        Gate::authorize('admin-docente');
        $grupo = Grupo::loadForReport($grupo_id);
        $inscripciones = Inscripcion::loadForReport($grupo_id);
        $modulos = $inscripciones->first()->notas;

        return view('nota.reporte', compact('inscripciones', 'grupo', 'modulos'));
    }

    public function store(StoreNotaRequest $request)
    {
        Gate::authorize('admin-docente');
        Nota::create($request->all());
        return back();
    }

    public function edit(Nota $nota, $matricula_id, $grupo_id)
    {
        Gate::authorize('admin-docente');
        return view('nota.edit', compact('nota', 'grupo_id', 'matricula_id'));
    }

    public function update(UpdateNotaRequest $request, Nota $nota)
    {
        Gate::authorize('admin-docente');
        $nota->update($request->all());
        return redirect()->route('notas.agregar', [$request->matricula_id, $request->grupo_id]);
    }
}
