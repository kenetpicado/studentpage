<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inscripcion;
use App\Models\Mensaje;
use App\Models\Nota;

class ConsultaController extends Controller
{
    public function index()
    {
        if ($this->isAlumno())
        return response()->json(Inscripcion::getByMatricula(), 200);

        $this->noAlumno();
    }

    public function notas($inscripcion_id)
    {
        return response()->json(Nota::index($inscripcion_id), 200);
    }

    public function mensajes($grupo_id)
    {
        return response()->json(Mensaje::getByGrupo($grupo_id), 200);
    }

    public function isAlumno()
    {
        return auth()->user()->rol == 'alumno';
    }

    public function noAlumno()
    {
        return response()->json([
            'status' => '0',
            'message' => 'No es alumno',
        ], 403);
    }

    public function isAutorizado()
    {
        return true;
    }

    public function noAutorizado()
    {
        return response()->json([
            'status' => '0',
            'message' => 'No es propietario de este registro'
        ], 403);
    }
}
