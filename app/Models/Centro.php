<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;

    protected $guarded = [];

    //FUNCION PARA CADENA EN MAYUSCULA
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(strtoupper($value));
    }
    public function setDepartamentoAttribute($value)
    {
        $this->attributes['departamento'] = trim(strtoupper($value));
    }
    public function setMunicipioAttribute($value)
    {
        $this->attributes['municipio'] = trim(strtoupper($value));
    }
    public function setDireccionAttribute($value)
    {
        $this->attributes['direccion'] = trim(strtoupper($value));
    }
}
