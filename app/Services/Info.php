<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class Info
{
    public function home()
    {
        $matriculas = auth()->user()->sucursal != 'all'
            ? DB::table('matriculas')->where('sucursal', auth()->user()->sucursal)->get(['id', 'activo', 'created_at'])
            : DB::table('matriculas')->get(['id', 'activo', 'created_at']);

        $docentes = auth()->user()->sucursal != 'all'
            ? DB::table('docentes')->where('sucursal', auth()->user()->sucursal)->get(['id', 'activo'])
            : DB::table('docentes')->get(['id', 'activo']);

        $grupos = auth()->user()->sucursal != 'all'
            ? DB::table('grupos')->where('sucursal', auth()->user()->sucursal)->get(['id', 'activo', 'anyo'])
            : DB::table('grupos')->get(['id', 'activo', 'anyo']);

        $cursos = DB::table('cursos')->get(['id', 'activo']);
        $promotores = DB::table('promotors')->get('id');

        return [
            'docentes_total' => $docentes->count(),
            'cursos_total' => $cursos->count(),
            'grupos_total' => $grupos->count(),
            'matriculas_total' => $matriculas->count(),
            'promotores_total' => $promotores->count(),

            'docentes_activos' => $docentes->where('activo', '1')->count(),
            'cursos_activos' => $cursos->where('activo', '1')->count(),
            'grupos_activos' => $grupos->where('activo', '1')->count(),
            'matriculas_activos' => $matriculas->where('activo', '1')->count(),

            'grupos_anyo' => $grupos->where('anyo', date('Y'))->count(),
            'grupos_anyo_activo' => $grupos->where('anyo', date('Y'))->where('activo', '1')->count(),
            'matriculas_anyo' => $matriculas->where('created_at', '>=', date('Y') . '-01-01')->count(),
            'matriculas_anyo_activo' => $matriculas->where('created_at', '>=', date('Y') . '-01-01')->where('activo', '1')->count(),
        ];
    }

    public function promotor($matriculas)
    {
        return [
            'matriculas_total' => $matriculas->count(),
            'matriculas_ch_total' => $matriculas->where('sucursal', 'CH')->count(),
            'matriculas_mg_total' => $matriculas->where('sucursal', 'MG')->count(),

            'matriculas' => $matriculas->where('activo', '1')->count(),
            'matriculas_ch' => $matriculas->where('activo', '1')->where('sucursal', 'CH')->count(),
            'matriculas_mg' => $matriculas->where('activo', '1')->where('sucursal', 'MG')->count(),

            'matriculas_anyo' => $matriculas->where('created_at', '>=', date('Y') . '-01-01')->count(),
            'matriculas_anyo_activas' => $matriculas->where('created_at', '>=', date('Y') . '-01-01')->where('activo', '1')->count(),
        ];
    }

    public function docente($grupos)
    {
        return [
            'grupos_total' => $grupos->count(),
            'grupos' => $grupos->where('activo', '1')->count(),
            'grupos_inactivos' => $grupos->where('activo', '0')->count(),
            'grupos_anyo' => $grupos->where('anyo', date('Y'))->count(),
        ];
    }

    //Obtener porcentaje
    public function porcentaje($modelo, $columna, $valor)
    {
        return $modelo->count() > 0
            ? round($modelo->where($columna, $valor)->count() * 100 / $modelo->count(), 1)
            : '0';
    }
}
