<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class Info
{
    public function home()
    {
        $matriculas = DB::table('matriculas')
            ->when(auth()->user()->sucursal != 'all', function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->where('activo', 1)
            ->get(['id', 'activo', 'created_at']);

        $docentes = DB::table('docentes')
            ->when(auth()->user()->sucursal != 'all', function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->where('activo', 1)
            ->get(['id', 'activo']);

        $grupos = DB::table('grupos')
            ->when(auth()->user()->sucursal != 'all', function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->where('activo', 1)
            ->get(['id', 'activo', 'anyo']);

        $cursos = DB::table('cursos')->get(['id', 'activo']);
        $promotores = DB::table('promotors')->get('id');

        return [
            'docentes_total' => $docentes->count(),
            'cursos_total' => $cursos->count(),
            'grupos_total' => $grupos->count(),
            'matriculas_total' => $matriculas->count(),
            'promotores_total' => $promotores->count(),

            'grupos_anyo' => $grupos->where('anyo', date('Y'))->count(),
            'matriculas_anyo' => $matriculas->where('created_at', '>=', date('Y') . '-01-01')->count(),
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
