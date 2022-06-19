<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\Inscripcion;
use Carbon\Carbon;

class Grupo extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public static function getToReport($grupo_id)
    {
        return Grupo::where('id', $grupo_id)->withCursoDocente()->first();
    }

    //Cargar 1 Grupo para editar
    public static function loadThis($grupo_id)
    {
        return Grupo::withDocente()->withInsc()->find($grupo_id);
    }

    //Grupos para Inscripcion - create
    public static function getForInsc($sucursal)
    {
        return Grupo::sucursal($sucursal)
            ->status('1')
            ->thisYear()
            ->withCursoDocente()
            ->orderDesc()
            ->attrInsc()
            ->get();
    }

    //Grupos para Inscripcion - edit
    public static function getEditInsc($sucursal, $id)
    {
        return Grupo::sucursal($sucursal)
            ->status('1')
            ->typeCurso($id)
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
            ->withCursoDocente()
            ->withInsc()
            ->orderDesc()
            ->attributes()
            ->get();
    }

    //Grupos de 1 Docente
    public static function getGruposDocente($id, $activo = '1')
    {
        return Grupo::docenteId($id)
            ->status($activo)
            ->withCursoDocente()
            ->withInsc()
            ->orderDesc()
            ->attributes()
            ->get();
    }

    //Obtener Grupos
    public static function getGrupos($activo = '1')
    {
        return Grupo::status($activo)
            ->withCursoDocente()
            ->withInsc()
            ->orderDesc()
            ->attributes()
            ->get();
    }

    /* SCOPES */
    public function scopeStatus($q, $activo)
    {
        return $q->where('activo', $activo);
    }

    public function scopeThisYear($q)
    {
        return $q->where('anyo', Carbon::now()->format('Y'));
    }

    public function scopeDocenteId($q, $id)
    {
        return $q->where('docente_id', $id);
    }

    public function scopeSucursal($q, $sucursal)
    {
        return $q->where('sucursal', $sucursal);
    }

    public function scopeTypeCurso($q, $id)
    {
        return $q->where('curso_id', $id);
    }

    public function scopewithCursoDocente($q)
    {
        return $q->with('curso:id,nombre')->with('docente:id,nombre');
    }

    public function scopeWithDocente($q)
    {
        return $q->with('docente:id,nombre');
    }

    public function scopeWithInsc($q)
    {
        return $q->with('inscripciones');
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
    /* SCOPES */

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
