<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matricula;

class Prematricula extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function matricula()
    {
        return $this->hasOne(Matricula::class);
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
    public function setMadreAttribute($value)
    {
        $this->attributes['madre'] = trim(strtoupper($value));
    }
    public function setPadreAttribute($value)
    {
        $this->attributes['padre'] = trim(strtoupper($value));
    }
    public function setGradoAttribute($value)
    {
        $this->attributes['grado'] = trim(strtoupper($value));
    }
}
