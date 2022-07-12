<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inscripcion;
use App\Models\Mensaje;
use App\Models\Nota;
use App\Models\Pago;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    //Ventana principal de consulta de alumno
    public function index()
    {
        if (auth()->user()->rol != 'alumno')
            return response()->json([
                'status' => '0',
                'message' => 'No es alumno',
            ], 403);

        $inscripciones = Inscripcion::getByMatricula();
        return response()->json($inscripciones, 200);
    }

    //Ver notas de un curso
    public function notas($inscripcion_id)
    {
        //Gate::authorize('alumno_autorizado', $inscripcion_id);
        $notas = Nota::getByInscripcion($inscripcion_id);
        return response()->json($notas, 200);
    }

    //Ver pagos de un curso
    public function pagos($inscripcion_id)
    {
        //Gate::authorize('alumno_autorizado', $inscripcion_id);
        $pagos = Pago::getByInscripcion($inscripcion_id);
        return response()->json($pagos, 200);
    }

    //Ver mensajes de un curso
    public function mensajes($grupo_id)
    {
        //Gate::authorize('alumno_autorizado_mensajes', $grupo_id);
        $mensajes = Mensaje::getByGrupo($grupo_id);
        return response()->json($mensajes, 200);
    }
}
