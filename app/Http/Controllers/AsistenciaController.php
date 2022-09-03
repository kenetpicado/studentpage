<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Matricula;
use App\Models\Asistencia;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AsistenciaController extends Controller
{
    /**
     * Formulario crear asistencias de un grupo
     *
     * @param  int $grupo_id
     * @return view
     */
    public function index($grupo_id)
    {
        Gate::authorize('docente_autorizado', $grupo_id);
        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        return view('asistencia.index', compact('inscripciones', 'grupo_id'));
    }

    /**
     * Editar las asistencias de un estudiante
     *
     * @param  int $inscripcion_id
     * @return view
     */
    public function edit($inscripcion_id)
    {
        $inscripcion = DB::table('inscripciones')->find($inscripcion_id);
        Gate::authorize('docente_autorizado', $inscripcion->grupo_id);
        $asistencias = DB::table('asistencias')->where('inscripcion_id', $inscripcion_id)->get();
        $matricula = DB::table('matriculas')->find($inscripcion->matricula_id, ['id', 'nombre']);
        return view('asistencia.edit', compact('asistencias', 'inscripcion', 'matricula'));
    }

    /**
     * Guardar asistencias
     * Actualizar estado de la Matricula
     *
     * @param  Request $request
     * @return view
     */
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

            /* Guardar asistencia */
            Asistencia::create([
                'present' => $request->present[$key],
                'created_at' => $request->created_at,
                'inscripcion_id' => $inscripcion_id,
            ]);
        }

        return redirect()->route('grupos.show', $request->grupo_id)->with('success', config('app.created'));
    }

    public function update(Request $request)
    {
        $asistencias = Asistencia::find($request->asistencia_id, ['id', 'present']);
        $matricula = Matricula::find($request->matricula_id, ['id', 'activo', 'inasistencias']);

        foreach ($asistencias as $key => $asistencia) {

            /* Solo si es diferente se actualiza */
            if ($asistencia->present != $request->present[$key]) {

                /* Presente */
                if ($request->present[$key] == '1' && $matricula->inasistencias != '0')
                    $matricula->update(['inasistencias' => '0']);

                /* Ausente */
                if ($request->present[$key] == '0') {
                    $matricula->increment('inasistencias');

                    if ($matricula->inasistencias > 2)
                        $matricula->update(['activo' => 0]);
                }

                /* Actualizar */
                $asistencia->update(['present' => $request->present[$key]]);
            }
        }

        return redirect()->route('grupos.show', $request->grupo_id)->with('success', config('app.updated'));
    }

    /**
     * Generar reporte de asistencia
     * de un grupo
     *
     * @param  int $grupo_id
     * @return view
     */
    public function show($grupo_id)
    {
        Gate::authorize('docente_autorizado', $grupo_id);
        $grupo = Grupo::reporte($grupo_id);
        $inscripciones = Inscripcion::asistencia($grupo_id);

        if ($inscripciones->count() == 0)
            return redirect()->route('reportes.grupos')->with('error', config('app.empty'));

        return view('asistencia.show', compact('grupo', 'inscripciones'));
    }
}
