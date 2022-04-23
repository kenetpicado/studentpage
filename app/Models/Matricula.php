<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pago;
use App\Models\Grupo;
use App\Models\Promotor;
use App\Models\Nota;
use App\Models\GrupoMatricula;

class Matricula extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relacion 1:m a pago
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    //Relacion 1:1 inversa a promotor
    public function promotor()
    {
        return $this->belongsTo(Promotor::class);
    }

    //Relacion n:m a grupos
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class);
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

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    // public function getFechaNacAttribute($value)
    // {
    //     return date('d-m-Y', strtotime($value));
    // }
}
