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

    //Obtener todos los docentes
    public static function getDocentes()
    {
        return Docente::orderAsc()->get();
    }

    //Obtener Docentes de un sucursal
    public static function getDocentesSucursal()
    {
        return Docente::sucursal(auth()->user()->sucursal)
            ->orderAsc()
            ->get();
    }

    //Obtener Docentes activos de una sucursal
    public static function getDocentesActivosSucursal($sucursal)
    {
        return Docente::sucursal($sucursal)
            ->activo()
            ->orderAsc()
            ->get(['id', 'nombre']);
    }

    //Obtener Docentes activos
    public static function getDocentesActivos()
    {
        return Docente::activo()
            ->orderAsc()
            ->get(['id', 'nombre']);
    }

    /* SCOPES */
    public function scopeOrderAsc($q)
    {
        return $q->orderBy('nombre');
    }

    public function scopeSucursal($q, $sucursal)
    {
        return $q->where('sucursal', $sucursal);
    }

    public function scopeAcTivo($q)
    {
        return $q->where('activo', '1');
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(ucwords(strtolower($value)));
    }

    public function setCorreoAttribute($value)
    {
        $this->attributes['correo'] = trim(strtolower($value));
    }

    //Relacion 1:n a Grupos
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
