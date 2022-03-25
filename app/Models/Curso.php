<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $guarded = [];
    
     //FUNCION PARA CADENA EN MAYUSCULA
     public function setNombreAttribute($value)
     {
         $this->attributes['nombre'] = trim(strtoupper($value));
     }
}
