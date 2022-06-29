<?php

namespace App\Http\Controllers;

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

    //Ver detalles de un curso
    public function show(Inscripcion $inscripcion)
    {
        Gate::authorize('propietario-nota', $inscripcion);
        $inscripcion->load(['notas', 'pagos']);
        return view('consulta.show', compact('inscripcion'));
    }
}
