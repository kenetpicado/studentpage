<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'estado'];
    public $timestamps = false;

    //FUNCION PARA CADENA EN MAYUSCULA
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(strtoupper($value));
    }

    //Relacion 1:n a grupos
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
