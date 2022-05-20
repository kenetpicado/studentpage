<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = ['carnet', 'nombre', 'correo', 'activo', 'sucursal'];
    public $timestamps = false;

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(strtoupper($value));
    }

    public function setCorreoAttribute($value)
    {
        $this->attributes['correo'] = trim(strtolower($value));
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public static function getDocentes()
    {
        return Docente::all();
    }

    public static function getDocentesSucursal($sucursal)
    {
        return Docente::where('sucursal', $sucursal)->get();
    }

    public static function getDocentesActivos()
    {
        return Docente::where('activo', '1')->get(['id', 'nombre']);
    }

    public static function getDocentesActivosSucursal($sucursal)
    {
        return Docente::where('activo', '1')
            ->where('sucursal', $sucursal)
            ->get(['id', 'nombre']);
    }
}
