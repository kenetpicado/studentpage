<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Pago;
use App\Models\Mensaje;
use App\Models\Inscripcion;
use App\Models\Matricula;
use Illuminate\Support\Facades\Gate;

class ConsultaController extends Controller
{
    //Ventana principal de consulta de alumno
    public function index()
    {
        $activo = Matricula::find(auth()->user()->sub_id, ['activo'])->activo;
        $inscripciones = Inscripcion::getByMatricula();
        return view('consulta.index', compact('inscripciones', 'activo'));
    }

    //Ver notas de un curso
    public function notas($inscripcion_id)
    {
        Gate::authorize('alumno-nota', $inscripcion_id);
        $notas = Nota::getByInscripcion($inscripcion_id);
        return view('consulta.nota', compact('notas'));
    }

    //Ver mensajes de un curso
    public function mensajes($grupo_id)
    {
        Gate::authorize('alumno-mensaje', $grupo_id);
        $mensajes = Mensaje::getByGrupo($grupo_id);
        return view('consulta.mensaje', compact('mensajes'));
    }
}
