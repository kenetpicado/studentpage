<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Grupo;
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
        $promotores = auth()->user()->sucursal != 'all'
            ? Promotor::with(['matriculas' => function ($q) {
                $q->select(['id', 'sucursal', 'activo', 'promotor_id'])
                    ->where('sucursal', auth()->user()->sucursal);
            }])
            ->orderBy('nombre')
            ->get(['id', 'carnet', 'nombre'])

            : Promotor::with('matriculas:id,sucursal,activo,promotor_id')
            ->orderBy('nombre')
            ->get(['id', 'carnet', 'nombre']);

        return view('reporte.promotores', compact('promotores'));
    }

    public function docentes()
    {
        $docentes = auth()->user()->sucursal != 'all'
            ? Docente::with('grupos:id,activo')
            ->where('sucursal', auth()->user()->sucursal)
            ->orderBy('sucursal')
            ->latest('activo')
            ->orderBy('nombre')
            ->get(['id', 'carnet', 'nombre', 'sucursal', 'activo'])
            : Docente::with('grupos:id,activo')
            ->orderBy('sucursal')
            ->latest('activo')
            ->orderBy('nombre')
            ->get(['id', 'carnet', 'nombre', 'sucursal', 'activo']);

        return view('reporte.docentes', compact('docentes'));
    }

    public function docente($docente_id)
    {
        
        return view('reporte.docente', compact('grupos'));
    }

    public function promotor($promotor_id)
    {
        $promotor = DB::table('promotors')->find($promotor_id);

        $matriculas = auth()->user()->sucursal != 'all'
            ? DB::table('matriculas')
            ->where('sucursal', auth()->user()->sucursal)
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
            ->get()

            : DB::table('matriculas')
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

        $info = (new Info)->promotor($matriculas);
        return view('reporte.promotor', compact('matriculas', 'promotor', 'info'));
    }
}
