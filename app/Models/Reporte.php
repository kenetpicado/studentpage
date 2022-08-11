<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reporte extends Model
{
    use HasFactory;

    public static function docente($docente_id)
    {
        return DB::table('grupos')
            ->where('docente_id', $docente_id)
            ->where('grupos.activo', '1')
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->select([
                'grupos.*',
                'cursos.nombre as curso',
                DB::raw('(select count(*) from inscripciones where grupos.id = inscripciones.grupo_id) as inscripciones_count')
            ])
            ->orderBy('curso')
            ->get();
    }

    public static function docentes()
    {
        return auth()->user()->sucursal != 'all'
            ? Docente::with(['grupos' => function ($q) {
                $q->select(['id', 'docente_id'])->where('activo', '1');
            }])
            ->where('sucursal', auth()->user()->sucursal)
            ->where('activo', '1')
            ->orderBy('nombre')
            ->get()

            : Docente::with(['grupos' => function ($q) {
                $q->select(['id', 'docente_id'])->where('activo', '1');
            }])
            ->where('activo', '1')
            ->orderBy('sucursal')
            ->orderBy('nombre')
            ->get();
    }

    public static function promotores()
    {
        return auth()->user()->sucursal != 'all'
            ? Promotor::with(['matriculas' => function ($q) {
                $q->select(['id', 'sucursal', 'promotor_id'])
                    ->where('activo', '1')
                    ->where('sucursal', auth()->user()->sucursal);
            }])
            ->orderBy('nombre')
            ->get(['id', 'carnet', 'nombre'])

            : Promotor::with(['matriculas' => function ($q) {
                $q->select(['id', 'sucursal', 'promotor_id'])
                    ->where('activo', '1');
            }])
            ->orderBy('nombre')
            ->get(['id', 'carnet', 'nombre']);
    }

    public static function promotor($promotor_id)
    {
        return auth()->user()->sucursal != 'all'
            ? DB::table('matriculas')
            ->where('sucursal', auth()->user()->sucursal)
            ->where('activo', '1')
            ->select([
                'id',
                'sucursal',
                'carnet',
                'nombre',
                'created_at',
            ])
            ->where('promotor_id', $promotor_id)
            ->orderBy('nombre')
            ->get()

            : DB::table('matriculas')
            ->where('activo', '1')
            ->select([
                'id',
                'sucursal',
                'carnet',
                'nombre',
                'created_at',
            ])
            ->where('promotor_id', $promotor_id)
            ->orderBy('nombre')
            ->get();
    }

    public static function promotor_rango($request, $promotor_id)
    {
        return auth()->user()->sucursal != 'all'
            ? DB::table('matriculas')
            ->where('sucursal', auth()->user()->sucursal)
            ->where('activo', '1')
            ->whereBetween('created_at', [$request->inicio, $request->fin])
            ->select([
                'id',
                'sucursal',
                'carnet',
                'nombre',
                'created_at',
            ])
            ->where('promotor_id', $promotor_id)
            ->orderBy('nombre')
            ->get()

            : DB::table('matriculas')
            ->where('activo', '1')
            ->whereBetween('created_at', [$request->inicio, $request->fin])
            ->select([
                'id',
                'sucursal',
                'carnet',
                'nombre',
                'created_at',
            ])
            ->where('promotor_id', $promotor_id)
            ->orderBy('nombre')
            ->get();
    }

    public static function matriculas_rango($request)
    {
        return auth()->user()->sucursal != 'all'
            ? DB::table('matriculas')
            ->where('activo', '1')
            ->where('sucursal', auth()->user()->sucursal)
            ->whereBetween('created_at', [$request->inicio, $request->fin])
            ->select([
                'id',
                'sucursal',
                'carnet',
                'nombre',
                'created_at',
            ])
            ->orderBy('created_at')
            ->orderBy('nombre')
            ->get()

            : DB::table('matriculas')
            ->where('activo', '1')
            ->whereBetween('created_at', [$request->inicio, $request->fin])
            ->select([
                'id',
                'sucursal',
                'carnet',
                'nombre',
                'created_at',
            ])
            ->orderBy('created_at')
            ->orderBy('nombre')
            ->get();
    }
}
