<?php

namespace App\Models;

use App\Casts\Lower;
use App\Casts\Ucwords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;
use App\Traits\rolesTraits;
use Illuminate\Support\Facades\DB;

class Docente extends Model
{
    use HasFactory;
    use rolesTraits;

    protected $fillable = ['carnet', 'nombre', 'correo', 'activo', 'sucursal'];
    public $timestamps = false;

    protected $casts = [
        'nombre' => Ucwords::class,
        'correo' => Lower::class,
    ];

    public static function index()
    {
        return DB::table('docentes')
            ->when(Docente::enSucursal(), function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->orderBy('nombre')->get();
    }

    public static function createGrupo()
    {
        return DB::table('docentes')
            ->when(Docente::enSucursal(), function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->where('activo', '1')
            ->orderBy('nombre')
            ->get(['id', 'nombre']);
    }

    //Obtener Docentes activos de una sucursal
    public static function sucursal($sucursal)
    {
        return DB::table('docentes')
            ->where('sucursal', $sucursal)
            ->where('activo', '1')
            ->orderBy('nombre')
            ->get(['id', 'nombre']);
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
