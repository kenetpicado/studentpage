<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Promotor;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;

class Matricula extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    //Cargar 1 matricula para editar
    public static function edit($matricula_id)
    {
        return Matricula::withInscripcion()
            ->find($matricula_id, ['id', 'nombre', 'cedula', 'fecha_nac', 'grado', 'tutor', 'tel']);
    }

    //Matricula del Alumno logged
    public static function getCurrent()
    {
        return Matricula::byCarnet()->first(['id', 'nombre', 'carnet']);
    }

    //Todas las Matriculas de sucursal
    public static function getMatriculasSucursal($sucursal)
    {
        return Matricula::sucursal($sucursal)
            ->withPromotor()
            ->withInscripcion()
            ->attributes()
            ->get();
    }

    //Desde Matricula Index
    public static function getMatriculasPromotor($promotor_id)
    {
        return Matricula::promotorId($promotor_id)
            ->withPromotor()
            ->withInscripcion()
            ->attributes()
            ->get();
    }

    //Obtener todas las Matriculas
    public static function getMatriculas()
    {
        return Matricula::withPromotor()
            ->withInscripcion()
            ->attributes()
            ->get();
    }

    //Desde Promotor Show
    public static function toPromotorShow($promotor_id)
    {
        $sucursal = auth()->user()->sucursal;
        $matriculas = Matricula::promotorId($promotor_id);

        if ($sucursal == 'all') {
            return $matriculas->withInscripcion()->attributes()->get();
        } else {
            return $matriculas->sucursal($sucursal)->withInscripcion()->attributes()->get();
        }
    }

    /* SCOPES */
    public function scopePromotorId($q, $p)
    {
        return $q->where('promotor_id', $p);
    }

    public function scopeSucursal($q, $s)
    {
        return $q->where('sucursal', $s);
    }

    public function scopeWithPromotor($q)
    {
        return $q->with('promotor:id,carnet');
    }

    public function scopeWithInscripcion($q)
    {
        return $q->with('inscripciones');
    }

    public function scopeAttributes($q)
    {
        return $q->select(['id', 'nombre', 'carnet', 'created_at', 'promotor_id'])
            ->orderBy('id', 'desc');
    }

    public function scopeByCarnet($q)
    {
        return $q->where('carnet', Auth::user()->email);
    }
    /* SCOPES */

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

    public function getCreatedAtAttribute($value)
    {
        return date('d F y', strtotime($value));
    }

    //Relacion 1:1 inversa a promotor
    public function promotor()
    {
        return $this->belongsTo(Promotor::class);
    }

    //Relacion 1:n inversa a promotor
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
