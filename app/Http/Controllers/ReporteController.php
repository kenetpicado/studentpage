<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Reporte;
use App\Services\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    /* Vista principal */
    public function index()
    {
        return view('reporte.index');
    }

    /* Reporte general de todos los promotores */
    public function promotores()
    {
        $promotors = DB::table('promotors')->orderBy('nombre')->get();
        return view('reporte.index_promotores', compact('promotors'));
    }

    /* Reporte general de un grupo */
    public function grupo($grupo_id)
    {
        $grupo = Grupo::reporte($grupo_id);
        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        return view('reporte.grupo', compact('inscripciones', 'grupo'));
    }

    /* Reporte general de un grupo */
    public function grupos()
    {
        $grupos = Grupo::index();
        return view('reporte.grupos', compact('grupos'));
    }

    /* Reporte general de un promotor*/
    public function promotor($promotor_id)
    {
        $promotor = DB::table('promotors')->find($promotor_id);
        $matriculas = Reporte::promotor($promotor_id);
        return view('reporte.promotor', compact('matriculas', 'promotor'));
    }

    /* Reporte general de todos los promotores */
    public function promotorGeneral()
    {
        $promotores = Reporte::promotores();
        return view('reporte.promotores', compact('promotores'));
    }

    /* Reporte por rango de fechas: matriculas de un promotor */
    public function promotor_rango(Request $request)
    {
        $request->validate([
            'carnet' => 'required',
            'inicio' => 'required|date',
            'fin' => 'required|date|after_or_equal:inicio'
        ]);

        $promotor = DB::table('promotors')->where('carnet', $request->carnet)->first();

        if (!$promotor)
            return redirect()->route('reportes.index')->with('error', 'No se ha encontrado ningun registro para: ' .  $request->carnet);

        $matriculas = Reporte::promotor_rango($request, $promotor->id);
        return view('reporte.promotor', compact('matriculas', 'promotor'));
    }

    /* Reporte por rango de fechas: matriculas */
    public function matriculas_rango(Request $request)
    {
        $request->validate([
            'inicio' => 'required|date',
            'fin' => 'required|date|after_or_equal:inicio'
        ]);

        $matriculas = Reporte::matriculas_rango($request);
        return view('reporte.matriculas', compact('matriculas', 'request'));
    }
}
