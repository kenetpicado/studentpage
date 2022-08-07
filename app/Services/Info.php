<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Info
{
    public function home()
    {
        $matriculas = auth()->user()->sucursal != 'all'
            ? DB::table('matriculas')->where('sucursal', auth()->user()->sucursal)->get(['id', 'activo'])
            : DB::table('matriculas')->get(['id', 'activo']);

        $docentes = auth()->user()->sucursal != 'all'
            ? DB::table('docentes')->where('sucursal', auth()->user()->sucursal)->get(['id', 'activo'])
            : DB::table('docentes')->get(['id', 'activo']);

        $grupos = auth()->user()->sucursal != 'all'
            ? DB::table('grupos')->where('sucursal', auth()->user()->sucursal)->get(['id', 'activo'])
            : DB::table('grupos')->get(['id', 'activo']);

        $cursos = DB::table('cursos')->get(['id', 'activo']);
        $promotores = DB::table('promotors')->get('id');

        return [
            'docentes_total' => $docentes->count(),
            'cursos_total' => $cursos->count(),
            'grupos_total' => $grupos->count(),
            'matriculas_total' => $matriculas->count(), 
            'promotores_total' => $promotores->count(),

            'docentes_activos' => $this->porcentaje($docentes, 'activo', '1'),
            'cursos_activos' => $this->porcentaje($cursos, 'activo', '1'),
            'grupos_activos' => $this->porcentaje($grupos, 'activo', '1'),
            'matriculas_ac' => $matriculas->where('activo', '1')->count(),
            'matriculas_activos' => $this->porcentaje($matriculas, 'activo', '1'),
        ];

    }

    public function promotor($matriculas)
    {
        return [
            'matriculas_total' => $matriculas->count(),
            'matriculas_activas' => $matriculas->where('activo', '1')->count(),
            'matriculas_anyo' => $matriculas->where('created_at', '>=', date('Y') . '-01-01')->count(),
            'matriculas_anyo_activas' => $matriculas->where('created_at', '>=', date('Y') . '-01-01')->where('activo', '1')->count(),
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
