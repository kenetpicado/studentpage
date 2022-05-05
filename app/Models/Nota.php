<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoMatricula;
use App\Models\Matricula;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['unidad', 'valor'];

    public function grupo_matricula()
    {
        return $this->belongsTo(GrupoMatricula::class);
    }

    //
    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function setUnidadAttribute($value)
    {
        $this->attributes['unidad'] = trim(strtoupper($value));
    }

}
