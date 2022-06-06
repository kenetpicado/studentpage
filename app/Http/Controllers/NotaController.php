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

    //Ver notas
    public function create($matricula_id, $grupo_id)
    {
        Gate::authorize('admin-docente');
        $inscripcion = Inscripcion::loadThisWith($grupo_id, $matricula_id, 'notas');
        return view('nota.index', compact('inscripcion', 'grupo_id'));
    }

    //Guardar nota
    public function store(StoreNotaRequest $request)
    {
        Gate::authorize('admin-docente');
        Nota::create($request->all());
        return back();
    }

    //Editar nota
    public function edit(Nota $nota, $matricula_id, $grupo_id)
    {
        Gate::authorize('admin-docente');
        return view('nota.edit', compact('nota', 'grupo_id', 'matricula_id'));
    }

    //Actualizar nota
    public function update(UpdateNotaRequest $request, Nota $nota)
    {
        Gate::authorize('admin-docente');
        $nota->update($request->all());
        return redirect()->route('notas.create', [$request->matricula_id, $request->grupo_id]);
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
    public function showCertified($matricula_id, $grupo_id)
    {
        Gate::authorize('admin');
        $inscripcion = Inscripcion::loadThis($grupo_id, $matricula_id);
        $notas = Nota::loadThis($inscripcion->id);
        return view('nota.certified', compact('notas', 'grupo_id'));
    }
}
