<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota;
use App\Models\Pago;
use App\Models\Matricula;
use App\Models\Grupo;
use App\Traits\ScopesTraits;

class Inscripcion extends Model
{
    use HasFactory, ScopesTraits;

    public $timestamps = false;
    protected $fillable = ['grupo_id', 'matricula_id'];

    protected $table = "inscripciones";

    //Para reporte de notas
    public static function getToReport($grupo_id)
    {
        return Inscripcion::loadGrupo($grupo_id)
            ->with(['matricula:id,nombre,carnet', 'notas'])
            ->get()
            ->sortBy('matricula.nombre');
    }

    //Obtener todas las inscripciones de una Matricula
    public static function getByMatricula()
    {
        return Inscripcion::loadMatricula(auth()->user()->sub_id)
            ->with([
                'grupo:id,curso_id,docente_id,anyo,horario',
                'grupo.curso:id,nombre',
                'grupo.docente:id,nombre'
            ])
            ->get();
    }

    //Obtener todas las inscripciones de un Grupo
    public static function getByGrupo($grupo_id)
    {
        return Inscripcion::loadGrupo($grupo_id)
            ->with('matricula:id,carnet,nombre')
            ->get()
            ->sortBy('matricula.nombre');
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
