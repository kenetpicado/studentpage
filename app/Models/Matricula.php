<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Promotor;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;

class Matricula extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    //Relacion 1:1 inversa a promotor
    public function promotor()
    {
        return $this->belongsTo(Promotor::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public static function getCurrent()
    {
        return Matricula::where('carnet', Auth::user()->email)
            ->first(['id', 'nombre', 'carnet', 'fecha_nac']);
    }

    public function obtain($q)
    {
        return $q->with(['promotor:id,carnet'])
            ->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'activo']);
    }

    public static function putActive($matricula_id)
    {
        Matricula::find($matricula_id, ['id', 'activo'])->update(['activo' => '1']);
    }

    public static function getMatriculasSucursal($sucursal)
    {
        return Matricula::obtain(Matricula::where('sucursal', $sucursal));
    }

    public static function getMatriculasPromotor($promotor_id)
    {
        return Matricula::obtain(Matricula::where('promotor_id', $promotor_id)->where('anyo', date('Y')));
    }

    public static function getMatriculas()
    {
        return Matricula::obtain(Matricula::matriculasWith());
    }

    //FUNCION PARA CADENA EN MAYUSCULA
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(ucwords(strtolower($value)));
    }

    public function setCedulaAttribute($value)
    {
        $this->attributes['cedula'] = trim(strtoupper($value));
    }

    public function setTutorAttribute($value)
    {
        $this->attributes['tutor'] = trim(ucwords(strtolower($value)));
    }

    public function setGradoAttribute($value)
    {
        $this->attributes['grado'] = trim(ucwords(strtolower($value)));
    }

    public function setCarnetAttribute($value)
    {
        $this->attributes['carnet'] = trim(strtoupper($value));
    }
}
