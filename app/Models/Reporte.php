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
