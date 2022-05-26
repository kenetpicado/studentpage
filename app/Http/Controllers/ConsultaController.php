<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Matricula;
use App\Models\Nota;
use App\Models\Pago;
use Illuminate\Support\Facades\Gate;

class ConsultaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Ventana principal de consulta de alumno
    public function index()
    {
        Gate::authorize('alumno');
        $matricula = Matricula::getCurrent();
        $inscripcion = Inscripcion::getThisMatricula($matricula->id);
        return view('consulta.index', compact('matricula', 'inscripcion'));
    }

    //Ver notas del propio alumno
    public function notas($inscripcion_id)
    {
        Gate::authorize('alumno-nota', $inscripcion_id);
        $notas = Nota::loadThis($inscripcion_id);
        return view('consulta.nota', compact('notas'));
    }

    //Ver pagos del propio alumno
    public function pagos($inscripcion_id)
    {
        Gate::authorize('alumno-nota', $inscripcion_id);
        $pagos = Pago::loadThis($inscripcion_id);
        return view('consulta.pago', compact('pagos'));
    }
}
