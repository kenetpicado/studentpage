<?php

namespace App\Models;

use App\Traits\rolesTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reporte extends Model
{
    use HasFactory;
    use rolesTraits;

    public static function docente($docente_id)
    {
        return DB::table('grupos')
            ->where('docente_id', $docente_id)
            ->where('grupos.activo', '1')
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->orderBy('curso')
            ->get([
                'grupos.*',
                'cursos.nombre as curso',
                DB::raw('(select count(*) from inscripciones where grupos.id = inscripciones.grupo_id) as inscripciones_count')
            ]);
    }

    public static function docentes()
    {
        return Docente::where('activo', '1')
            ->with(['grupos' => function ($q) {
                $q->select(['id', 'docente_id'])->where('activo', '1');
            }])
            ->when(Reporte::enSucursal(), function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->orderBy('sucursal')
            ->orderBy('nombre')
            ->get();
    }

    public static function promotores()
    {
        return Promotor::orderBy('nombre')
            ->with(['matriculas' => function ($q) {
                $q->where('activo', '1')
                    ->select(['id', 'sucursal', 'promotor_id'])
                    ->when(Reporte::enSucursal(), function ($q) {
                        $q->where('sucursal', auth()->user()->sucursal);
                    });
            }])
            ->get(['id', 'carnet', 'nombre']);
    }

    public static function promotor($promotor_id)
    {
        return DB::table('matriculas')
            ->where('activo', '1')
            ->when(Reporte::enSucursal(), function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->where('promotor_id', $promotor_id)
            ->orderBy('nombre')
            ->get([
                'id',
                'sucursal',
                'carnet',
                'nombre',
                'created_at',
            ]);
    }

    public static function promotor_rango($request, $promotor_id)
    {
        return DB::table('matriculas')
            ->where('activo', '1')
            ->when(Reporte::enSucursal(), function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->whereBetween('created_at', [$request->inicio, $request->fin])
            ->where('promotor_id', $promotor_id)
            ->orderBy('nombre')
            ->get([
                'id',
                'sucursal',
                'carnet',
                'nombre',
                'created_at',
            ]);
    }

    public static function matriculas_rango($request)
    {
        return DB::table('matriculas')
            ->where('activo', '1')
            ->when(Reporte::enSucursal(), function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->whereBetween('created_at', [$request->inicio, $request->fin])
            ->orderBy('created_at')
            ->orderBy('nombre')
            ->get([
                'id',
                'sucursal',
                'carnet',
                'nombre',
                'created_at',
            ]);
    }
}
