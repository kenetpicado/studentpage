<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Promotor;
use App\Models\GrupoMatricula;

class Matricula extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relacion 1:1 inversa a promotor
    public function promotor()
    {
        return $this->belongsTo(Promotor::class);
    }

    public function grupo_matricula()
    {
        return $this->hasMany(GrupoMatricula::class);
    }

    //FUNCION PARA CADENA EN MAYUSCULA
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(strtoupper($value));
    }
    public function setCedulaAttribute($value)
    {
        $this->attributes['cedula'] = trim(strtoupper($value));
    }
    public function setTutorAttribute($value)
    {
        $this->attributes['tutor'] = trim(strtoupper($value));
    }
    public function setGradoAttribute($value)
    {
        $this->attributes['grado'] = trim(strtoupper($value));
    }

    public function setCarnetAttribute($value)
    {
        $this->attributes['carnet'] = trim(strtoupper($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }
}
