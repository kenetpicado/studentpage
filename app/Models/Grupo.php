<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\Inscripcion;
use App\Traits\ScopesTraits;

class Grupo extends Model
{
    use HasFactory, ScopesTraits;

    protected $guarded = [];
    public $timestamps = false;

    //Obtener grupo para reporte de notas
    public static function getToReport($grupo_id)
    {
        return Grupo::withCursoDocente()->find($grupo_id);
    }

    //Grupos para crear y editar Inscripcion
    public static function getForInscripciones($sucursal)
    {
        return Grupo::sucursal($sucursal)
            ->activo()
            ->withCursoDocente()
            ->latestId()
            ->attrInsc()
            ->get();
    }

    //Grupos de 1 Sucursal
    public static function getGruposSucursal($activo = '1')
    {
        return Grupo::sucursal(auth()->user()->sucursal)
            ->activo($activo)
            ->attributes()
            ->withCursoDocente()
            ->countInscripciones()
            ->latestId()
            ->get();
    }

    //Grupos de 1 Docente
    public static function getGruposDocente($docente_id, $activo = '1')
    {
        return Grupo::whereDocente($docente_id)
            ->activo($activo)
            ->attributes()
            ->withCursoDocente()
            ->countInscripciones()
            ->latestId()
            ->get();
    }

    //Obtener todos los Grupos
    public static function getGrupos($activo = '1')
    {
        return Grupo::activo($activo)
            ->attributes()
            ->withCursoDocente()
            ->countInscripciones()
            ->latestId()
            ->get();
    }

    public function scopeAttributes($q)
    {
        return $q->select(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
    }

    public function scopeAttrInsc($q)
    {
        return $q->select(['id', 'horario', 'curso_id', 'docente_id']);
    }

    //Relacion n:1 a Curso
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    //Relacion n:1 a Docente
    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    //Relacion 1:n a Inscripciones
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function setHorarioAttribute($value)
    {
        $this->attributes['horario'] = trim(strtolower($value));
    }
}
