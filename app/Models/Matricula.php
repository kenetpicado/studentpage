<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pago;
use App\Models\Grupo;
use App\Models\Promotor;

class Matricula extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function grupo() 
    {
        return $this->belongsTo(Grupo::class);
    }

    public function promotor() 
    {
        return $this->belongsTo(Promotor::class);
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
        return date('d-m-Y', strtotime($value));
    }

    // public function getFechaNacAttribute($value)
    // {
    //     return date('d-m-Y', strtotime($value));
    // }
}
