<?php

namespace App\Models;

use App\Casts\Lower;
use App\Casts\Ucwords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = ['carnet', 'nombre', 'correo', 'activo', 'sucursal'];
    public $timestamps = false;

    protected $casts = [
        'nombre' => Ucwords::class,
        'correo' => Lower::class,
    ];

    //Obtener todos los docentes
    public static function getDocentes()
    {
        return DB::table('docentes')->orderBy('nombre')->get();
    }

    //Obtener Docentes de un sucursal
    public static function getDocentesSucursal()
    {
        return DB::table('docentes')
            ->where('sucursal', auth()->user()->sucursal)
            ->orderBy('nombre')->get();
    }

    //Obtener Docentes activos de una sucursal
    public static function getDocentesActivosSucursal($sucursal)
    {
        return DB::table('docentes')
            ->where('sucursal', $sucursal)
            ->where('activo', '1')
            ->orderBy('nombre')->get(['id', 'nombre']);
    }

    //Obtener Docentes activos
    public static function getDocentesActivos()
    {
        return DB::table('docentes')
            ->where('activo', '1')
            ->orderBy('nombre')->get(['id', 'nombre']);
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
