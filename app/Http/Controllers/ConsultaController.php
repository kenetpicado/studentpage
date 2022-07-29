<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Pago;
use App\Models\Mensaje;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Gate;

class ConsultaController extends Controller
{
    //Ventana principal de consulta de alumno
    public function index()
    {
        $inscripciones = Inscripcion::getByMatricula();
        return view('consulta.index', compact('inscripciones'));
    }

    //Ver notas de un curso
    public function notas($inscripcion_id)
    {
        Gate::authorize('alumno_autorizado', $inscripcion_id);
        $notas = Nota::getByInscripcion($inscripcion_id);
        return view('consulta.nota', compact('notas'));
    }

    //Ver mensajes de un curso
    public function mensajes($grupo_id)
    {
        Gate::authorize('alumno_autorizado_mensajes', $grupo_id);
        $mensajes = Mensaje::getByGrupo($grupo_id);
        return view('consulta.mensaje', compact('mensajes'));
    }
}
