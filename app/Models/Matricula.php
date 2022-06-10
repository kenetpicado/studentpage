<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Promotor;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Matricula extends Model
{
    use HasFactory;

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

    public static function edit($matricula_id)
    {
        return Matricula::find($matricula_id, ['id', 'nombre', 'cedula', 'fecha_nac', 'grado', 'tutor', 'tel']);
    }

    public static function getCurrent()
    {
        return Matricula::where('carnet', Auth::user()->email)
            ->first(['id', 'nombre', 'carnet', 'fecha_nac']);
    }

    public static function obtain($q)
    {
        return $q->with(['promotor:id,carnet'])
            ->withCount('inscripciones')
            ->orderBy('id', 'desc')
            ->get(['id', 'nombre', 'carnet', 'created_at', 'promotor_id']);
    }

    public static function getMatriculasSucursal($sucursal)
    {
        return Matricula::obtain(Matricula::where('sucursal', $sucursal));
    }

    //Desde Matricula Index
    public static function getMatriculasPromotor($promotor_id)
    {
        return Matricula::obtain(Matricula::where('promotor_id', $promotor_id)->where('anyo', date('Y')));
    }

    //Desde promotor Show
    public static function toPromotorShow($promotor_id)
    {
        return Matricula::where('promotor_id', $promotor_id)
            ->withCount('inscripciones')
            ->orderBy('id', 'desc')
            ->get(['id', 'nombre', 'carnet', 'created_at', 'promotor_id']);
    }

    public static function getMatriculas()
    {
        return Matricula::obtain(new Matricula());
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

    public function setPinAttribute($value)
    {
        $this->attributes['pin'] = trim(strtoupper($value));
    }
}
