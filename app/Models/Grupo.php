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
    public static function getToReport($id)
    {
        return Grupo::where('id', $id)
            ->withCursoDocente()
            ->first();
    }

    //Grupos para crear y editar Inscripcion
    public static function getForInscripciones($sucursal)
    {
        return Grupo::sucursal($sucursal)
            ->status('1')
            ->withCursoDocente()
            ->orderDesc()
            ->attrInsc()
            ->get();
    }

    //Grupos de 1 Sucursal
    public static function getGruposSucursal($activo = '1')
    {
        return Grupo::sucursal(auth()->user()->sucursal)
            ->status($activo)
            ->attributes()
            ->withCursoDocente()
            ->countInscripciones()
            ->orderDesc()
            ->get();
    }

    //Grupos de 1 Docente
    public static function getGruposDocente($id, $activo = '1')
    {
        return Grupo::docenteId($id)
            ->status($activo)
            ->attributes()
            ->withCursoDocente()
            ->countInscripciones()
            ->orderDesc()
            ->get();
    }

    //Obtener todos los Grupos
    public static function getGrupos($activo = '1')
    {
        return Grupo::status($activo)
            ->attributes()
            ->withCursoDocente()
            ->countInscripciones()
            ->orderDesc()
            ->get();
    }

    /* SCOPES */
    public function scopeStatus($q, $activo)
    {
        return $q->where('activo', $activo);
    }

    public function scopeDocenteId($q, $id)
    {
        return $q->where('docente_id', $id);
    }
    
    public function scopewithCursoDocente($q)
    {
        return $q->with('curso:id,nombre')->with('docente:id,nombre');
    }

    public function scopeWithDocente($q)
    {
        return $q->with('docente:id,nombre');
    }

    public function scopeAttributes($q)
    {
        return $q->select(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
    }

    public function scopeAttrInsc($q)
    {
        return $q->select(['id', 'horario', 'curso_id', 'docente_id']);
    }

    public function scopeOrderDesc($q)
    {
        return $q->orderBy('id', 'desc');
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
