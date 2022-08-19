<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Matricula;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

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

        foreach ($request->inscripcion_id as $key => $inscripcion_id) {

            $matricula = Matricula::find($request->matricula_id[$key], ['id', 'activo', 'inasistencias']);

            if ($request->present[$key] == '1')
                $matricula->update(['inasistencias' => '0']);
            else {
                $matricula->increment('inasistencias');

                if ($matricula->inasistencias > 2)
                    $matricula->update(['activo' => 0]);
            }

            Asistencia::create([
                'present' => $request->present[$key],
                'created_at' => $request->created_at,
                'inscripcion_id' => $inscripcion_id,
            ]);
        }

        return redirect()->route('grupos.show', $request->grupo_id)->with('success', config('app.created'));
    }

    public function show($grupo_id)
    {
        $grupo = Grupo::reporte($grupo_id);
        $inscripciones = Inscripcion::asistencia($grupo_id);
        return view('asistencia.show', compact('grupo', 'inscripciones'));
    }
}
