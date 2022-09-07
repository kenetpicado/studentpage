<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Nota;
use App\Models\Mensaje;
use App\Models\Inscripcion;
use App\Models\Matricula;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ConsultaController extends Controller
{
    //Ventana principal de consulta de alumno
    public function index()
    {
        $matricula = Matricula::find(auth()->user()->sub_id, ['activo', 'inasistencias']);
        $inscripciones = Inscripcion::getByMatricula();
        return view('consulta.index', compact('inscripciones', 'matricula'));
    }

    //Ver notas de un curso
    public function notas($inscripcion_id)
    {
        Gate::authorize('alumno-nota', $inscripcion_id);
        $notas = Nota::index($inscripcion_id);
        $grupo = DB::table('inscripciones')
            ->where('inscripciones.id', $inscripcion_id)
            ->join('grupos', 'inscripciones.grupo_id', '=', 'grupos.id')
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->first([
                'grupos.horario',
                'cursos.nombre',
            ]);
        return view('consulta.nota', compact('notas', 'grupo'));
    }

    //Ver mensajes de un curso
    public function mensajes($grupo_id)
    {
        Gate::authorize('alumno-mensaje', $grupo_id);
        $mensajes = Mensaje::getByGrupo($grupo_id);
        $grupo = Grupo::showThis($grupo_id);
        return view('consulta.mensaje', compact('mensajes', 'grupo'));
    }
}
