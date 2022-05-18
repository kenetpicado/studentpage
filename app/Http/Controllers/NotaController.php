<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests\UpdateNotaRequest;
use App\Models\Grupo;
use App\Models\Nota;
use App\Models\GrupoMatricula;
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

        //Obtener el grupo en la tabla pivot
        $pivot = GrupoMatricula::where('grupo_id', $grupo_id)
            ->where('matricula_id', $matricula_id)
            ->with('notas:id,created_at,unidad,valor,grupo_matricula_id')
            ->first();

        return view('nota.index', compact('pivot', 'grupo_id'));
    }

    public function reporte($grupo_id)
    {
        Gate::authorize('admin-docente');

        $grupo = Grupo::where('id', $grupo_id)
            ->with(['curso:id,nombre', 'docente:id,nombre'])
            ->first(['id', 'horario', 'sucursal', 'docente_id', 'curso_id']);

        $pivot = GrupoMatricula::where('grupo_id', $grupo_id)
            ->with([
                'notas' => function ($query) {
                    $query->select('id', 'unidad', 'valor', 'grupo_matricula_id')->orderBy('unidad');
                }
            ])
            ->with('matricula:id,nombre,carnet')
            ->get();

        $modulos = $pivot->first()->notas;

        return view('nota.reporte', compact('pivot', 'grupo', 'modulos'));
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
