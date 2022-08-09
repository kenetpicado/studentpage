<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Promotor;
use App\Services\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reporte.index');
    }

    public function promotores()
    {
        $promotores = Promotor::with('matriculas:id,sucursal,activo,promotor_id')
            ->orderBy('nombre')
            ->get(['id', 'carnet', 'nombre']);

        return view('reporte.promotores', compact('promotores'));
    }

    public function docentes()
    {
        $docentes = Docente::with('grupos')
            ->orderBy('sucursal')
            ->latest('activo')
            ->orderBy('nombre')
            ->get(['id', 'carnet', 'nombre', 'sucursal', 'activo']);

        return view('reporte.docentes', compact('docentes'));
    }

    public function promotor($promotor_id)
    {
        $promotor = DB::table('promotors')->find($promotor_id);

        $matriculas = DB::table('matriculas')
            ->select([
                'id',
                'sucursal',
                'activo',
                'carnet',
                'nombre',
                'created_at',
                DB::raw('(select count(*) from inscripciones where matriculas.id = inscripciones.matricula_id) as inscripciones_count')
            ])
            ->where('promotor_id', $promotor_id)
            ->latest('activo')
            ->latest('inscripciones_count')
            ->orderBy('nombre')
            ->get();

        $info = [
            'matriculas_total' => $matriculas->count(),
            'matriculas_ch_total' => $matriculas->where('sucursal', 'CH')->count(),
            'matriculas_mg_total' => $matriculas->where('sucursal', 'MG')->count(),

            'matriculas' => $matriculas->where('activo', '1')->count(),
            'matriculas_ch' => $matriculas->where('activo', '1')->where('sucursal', 'CH')->count(),
            'matriculas_mg' => $matriculas->where('activo', '1')->where('sucursal', 'MG')->count(),
        ];
        return view('reporte.promotor', compact('matriculas', 'promotor', 'info'));
    }
}
