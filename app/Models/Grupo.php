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
        return Grupo::where('id', $grupo_id)->withData()->first();
    }

    //Cargar 1 Grupo para editar
    public static function loadThis($grupo_id)
    {
        return Grupo::withDocente()->withInsc()->find($grupo_id);
    }

    //Grupos para Inscripcion - create
    public static function getForInsc($s)
    {
        return Grupo::sucursal($s)
            ->status('1')
            ->thisYear()
            ->withData()
            ->orderDesc()
            ->attrInsc()
            ->get();
    }

    //Grupos para Inscripcion - edit
    public static function getEditInsc($s, $id)
    {
        return Grupo::sucursal($s)
            ->status('1')
            ->typeCurso($id)
            ->withData()
            ->orderDesc()
            ->attrInsc()
            ->get();
    }

    //Grupos de 1 Sucursal
    public static function getGruposSucursal($s = '1')
    {
        return Grupo::sucursal(auth()->user()->sucursal)
            ->status($s)
            ->withData()
            ->withInsc()
            ->orderDesc()
            ->attributes()
            ->get();
    }

    //Grupos de 1 Docente
    public static function getGruposDocente($id, $s = '1')
    {
        return Grupo::docenteId($id)
            ->status($s)
            ->withData()
            ->withInsc()
            ->orderDesc()
            ->attributes()
            ->get();
    }

    //Obtener Grupos
    public static function getGrupos($s = '1')
    {
        return Grupo::status($s)
            ->withData()
            ->withInsc()
            ->orderDesc()
            ->attributes()
            ->get();
    }

    /* SCOPES */
    public function scopeStatus($q, $s)
    {
        return $q->where('activo', $s);
    }

    public function scopeThisYear($q)
    {
        return $q->where('anyo', Carbon::now()->format('Y'));
    }

    public function scopeDocenteId($q, $id)
    {
        return $q->where('docente_id', $id);
    }

    public function scopeSucursal($q, $s)
    {
        return $q->where('sucursal', $s);
    }

    public function scopeTypeCurso($q, $c)
    {
        return $q->where('curso_id', $c);
    }

    public function scopeWithData($q)
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
