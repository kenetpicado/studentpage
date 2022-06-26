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

    //Todas las Matriculas de sucursal
    public static function getMatriculasSucursal()
    {
        return Matricula::sucursal(auth()->user()->sucursal)
            ->attributes()
            ->withInscripcion()
            ->get();
    }

    //Matriculas de un Promotor (Index)
    public static function getMatriculasPromotor($promotor_id)
    {
        return Matricula::wherePromotor($promotor_id)
            ->attributes()
            ->withInscripcion()
            ->get();
    }

    //Matriculas de un Promotor (Show)
    public static function toPromotorShow($promotor_id)
    {
        if (auth()->user()->sucursal == 'all')
            return Matricula::wherePromotor($promotor_id)
                ->attributes()
                ->withInscripcion()
                ->get();

        return Matricula::wherePromotor($promotor_id)
            ->sucursal(auth()->user()->sucursal)
            ->attributes()
            ->withInscripcion()
            ->get();
    }

    //Obtener todas las Matriculas
    public static function getMatriculas()
    {
        return Matricula::attributes()
            ->withInscripcion()
            ->get();
    }

    /* SCOPES */
    public function scopeWherePromotor($q, $promotor_id)
    {
        return $q->where('promotor_id', $promotor_id);
    }

    public function scopeSucursal($q, $sucursal)
    {
        return $q->where('sucursal', $sucursal);
    }

    public function scopeWithInscripcion($q)
    {
        return $q->withCount('inscripciones');
    }

    public function scopeAttributes($q)
    {
        return $q->select(['id', 'nombre', 'carnet', 'created_at', 'promotor_id'])
            ->orderBy('id', 'desc');
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

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
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
