<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota;
use App\Models\Pago;
use App\Models\Matricula;
use App\Models\Grupo;

class Inscripcion extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['grupo_id', 'matricula_id'];

    protected $table = "inscripciones";

    public static function getToReport($grupo_id)
    {
        return Inscripcion::where('grupo_id', $grupo_id)
            ->with(['notas', 'matricula:id,nombre,carnet'])
            ->get();
    }

    public static function getByMatricula($matricula_id)
    {
        return Inscripcion::where('matricula_id', $matricula_id)
            ->with(['grupo:id,curso_id,docente_id', 'grupo.curso:id,nombre', 'grupo.docente:id,nombre'])
            ->get();
    }

    public static function getByGrupo($grupo_id)
    {
        return Inscripcion::where('grupo_id', $grupo_id)
            ->with('matricula:id,carnet,nombre')
            ->get();
    }

    //Cargar 1 Grupo With
    public static function loadWithGrupo($m, $g)
    {
        return Inscripcion::getThis($m, $g)
            ->with('grupo:id,sucursal,curso_id')
            ->first();
    }

    //Cargar 1 Grupo para notas y pagos
    public static function loadThis($m, $g)
    {
        return Inscripcion::getThis($m, $g)->first();
    }

    /* SCOPES */
    public function scopeGetThis($q, $m, $g)
    {
        return $q->where('matricula_id', $m)->where('grupo_id', $g);
    }

    // RELACIONES
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class)->orderBy('num');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
