<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\Matricula;
use App\Models\GrupoMatricula;

class Grupo extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function curso() 
    {
        return $this->belongsTo(Curso::class);
    }

    public function docente() 
    {
        return $this->belongsTo(Docente::class);
    }

    public function matriculas()
    {
        return $this->belongsToMany(Matricula::class)->withPivot('id');
    }

    public function setHorarioAttribute($value)
    {
        $this->attributes['horario'] = trim(strtoupper($value));
    }
}
