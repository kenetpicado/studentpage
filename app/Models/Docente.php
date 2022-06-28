<?php

namespace App\Models;

use App\Casts\Lower;
use App\Casts\Ucwords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;
use App\Traits\ScopesTraits;

class Docente extends Model
{
    use HasFactory, ScopesTraits;

    protected $fillable = ['carnet', 'nombre', 'correo', 'activo', 'sucursal'];
    public $timestamps = false;

    protected $casts = [
        'nombre' => Ucwords::class,
        'correo' => Lower::class,
    ];

    //Obtener todos los docentes
    public static function getDocentes()
    {
        return Docente::orderNombre()->get();
    }

    //Obtener Docentes de un sucursal
    public static function getDocentesSucursal()
    {
        return Docente::sucursal(auth()->user()->sucursal)->orderNombre()->get();
    }

    //Obtener Docentes activos de una sucursal
    public static function getDocentesActivosSucursal($sucursal)
    {
        return Docente::sucursal($sucursal)->activo()->orderNombre()->get(['id', 'nombre']);
    }

    //Obtener Docentes activos
    public static function getDocentesActivos()
    {
        return Docente::activo()->orderNombre()->get(['id', 'nombre']);
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
