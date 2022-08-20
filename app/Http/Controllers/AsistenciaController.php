<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Matricula;
use App\Models\Asistencia;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AsistenciaController extends Controller
{
    public function index($grupo_id)
    {
        Gate::authorize('docente_autorizado', $grupo_id);
        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        return view('asistencia.index', compact('inscripciones', 'grupo_id'));
    }

    public function store(Request $request)
    {
        Gate::authorize('docente_autorizado', $request->grupo_id);
        $matricula = Matricula::find($request->matricula_id, ['id', 'activo', 'inasistencias']);

        foreach ($request->inscripcion_id as $key => $inscripcion_id) {

            /* Presente */
            if ($request->present[$key] == '1' && $matricula[$key]->inasistencias != '0')
                $matricula[$key]->update(['inasistencias' => '0']);

            /* Ausente */
            if ($request->present[$key] == '0') {
                $matricula[$key]->increment('inasistencias');

                if ($matricula[$key]->inasistencias > 2)
                    $matricula[$key]->update(['activo' => 0]);
            }

            Asistencia::create([
                'present' => $request->present[$key],
                'created_at' => $request->created_at,
                'inscripcion_id' => $inscripcion_id,
            ]);
        }

        return redirect()->route('grupos.show', $request->grupo_id)->with('success', config('app.created'));
    }

    /* Reporte de asistencias */
    public function show($grupo_id)
    {
        Gate::authorize('docente_autorizado', $grupo_id);
        $grupo = Grupo::reporte($grupo_id);
        $inscripciones = Inscripcion::asistencia($grupo_id);
        return view('asistencia.show', compact('grupo', 'inscripciones'));
    }
}
