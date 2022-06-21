<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests\UpdateNotaRequest;
use App\Models\Grupo;
use App\Models\Nota;
use App\Models\Inscripcion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class NotaController extends Controller
{
    //Ver notas
    public function index($inscripcion_id)
    {
        Gate::authorize('admin-docente');
        $inscripcion = Inscripcion::withNotas($inscripcion_id);
        return view('nota.index', compact('inscripcion'));
    }

    //Guardar nota
    public function store(StoreNotaRequest $request)
    {
        Gate::authorize('admin-docente');

        $request->merge([
            'created_at' => Carbon::now()->format('Y-m-d')
        ]);

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

    //Ver reporte de notas
    public function reporte($grupo_id)
    {
        Gate::authorize('admin-docente');
        $grupo = Grupo::getToReport($grupo_id);
        $inscripciones = Inscripcion::getToReport($grupo_id);
        return view('nota.show', compact('inscripciones', 'grupo'));
    }

    //Ver certificado de notas
    public function showCertified($grupo_id, $matricula_id)
    {
        Gate::authorize('admin');
        $inscripcion = Inscripcion::loadThis($matricula_id, $grupo_id);
        $notas = Nota::loadThis($inscripcion->id);
        return view('nota.certified', compact('notas', 'grupo_id'));
    }
}
