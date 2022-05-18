<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\GrupoMatricula;
use Illuminate\Support\Facades\DB;

class Grupo extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function obtain($q)
    {
        return $q->with(['curso:id,nombre', 'docente:id,nombre'])
            ->withCount('grupo_matricula')
            ->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
    }

    public static function getGruposSucursal($sucursal)
    {
        return Grupo::obtain(Grupo::where('sucursal', $sucursal));
    }

    public static function getGruposCurrents($sucursal)
    {
        return Grupo::where('sucursal', $sucursal)
            ->where('anyo', date('Y'))
            ->with(['docente:id,nombre', 'curso:id,nombre'])
            ->get(['id', 'horario', 'curso_id', 'docente_id']);
    }

    public static function getGruposDocente($docente_id)
    {
        return Grupo::obtain(Grupo::where('docente_id', $docente_id));
    }

    public static function getGrupos()
    {
        return Grupo::obtain(new Grupo());
    }

    //Relations
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function grupo_matricula()
    {
        return $this->hasMany(GrupoMatricula::class);
    }

    public function setHorarioAttribute($value)
    {
        $this->attributes['horario'] = trim(strtoupper($value));
    }
}
