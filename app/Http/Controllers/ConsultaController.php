<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Matricula;
use Illuminate\Support\Facades\Auth;
use App\Models\Nota;
use App\Models\Pago;
use Illuminate\Support\Facades\Gate;

class ConsultaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Gate::authorize('alumno');
        //
        $user = Matricula::where('carnet', Auth::user()->email)->first(['id', 'nombre', 'carnet']);

        $pivot = Inscripcion::where('matricula_id', $user->id)
            ->with('grupo.curso:id,nombre', 'grupo.docente:id,nombre')
            ->get();

        return view('consulta.index', compact('user', 'pivot'));
    }

    //Ver notas del propio alumno
    public function notas($pivot_id)
    {
        Gate::authorize('alumno');

        Gate::authorize('nota_mine', $pivot_id);

        $notas = Nota::where('grupo_matricula_id', $pivot_id)->orderBy('unidad')->get(['id', 'unidad', 'valor']);
        return view('consulta.nota', compact('notas'));
    }

    //Ver pagos del propio alumno
    public function pagos($pivot_id)
    {
        Gate::authorize('alumno');

        Gate::authorize('nota_mine', $pivot_id);

        $pagos = Pago::where('grupo_matricula_id', $pivot_id)->get(['id', 'concepto', 'monto']);
        return view('consulta.pago', compact('pagos'));
    }
}
