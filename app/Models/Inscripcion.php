<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota;
use App\Models\Pago;
use Illuminate\Support\Facades\DB;

class Inscripcion extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['grupo_id', 'matricula_id'];

    protected $table = "inscripciones";

    //Para reporte de notas (ELOQUENT)
    public static function getToReport($grupo_id)
    {
        return Inscripcion::where('grupo_id', $grupo_id)
            ->where('matriculas.activo', '1')
            ->select([
                'inscripciones.id',
                'nombre as matricula_nombre',
                'carnet as matricula_carnet',
            ])
            ->join('matriculas', 'inscripciones.matricula_id', '=', 'matriculas.id')
            ->with(['notas' => function ($q) {
                $q->select([
                    'notas.*',
                    'modulos.nombre as mod'
                ])->join('modulos', 'notas.modulo_id', '=', 'modulos.id');
            }])
            ->get();
    }

    //Obtener todas las inscripciones de una Matricula
    public static function getByMatricula()
    {
        return DB::table('inscripciones')
            ->where('matricula_id', auth()->user()->sub_id)
            ->select([
                'inscripciones.id',
                'inscripciones.matricula_id',
                'grupos.id as grupo_id',
                'cursos.imagen as curso_imagen',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
            ])
            ->join('grupos', 'inscripciones.grupo_id', '=', 'grupos.id')
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->get();
    }

    //Obtener todas las inscripciones de un Grupo
    public static function getByGrupo($grupo_id)
    {
        return DB::table('inscripciones')
            ->where('inscripciones.grupo_id', $grupo_id)
            ->where('matriculas.activo', '1')
            ->select([
                'inscripciones.*',
                'matriculas.carnet as matricula_carnet',
                'matriculas.nombre as matricula_nombre',
            ])
            ->join('matriculas', 'inscripciones.matricula_id', '=', 'matriculas.id')
            ->orderBy('matriculas.nombre')
            ->get();
    }

    public static function withGrupoSucursal($inscripcion_id)
    {
        return DB::table('inscripciones')
            ->where('inscripciones.id', $inscripcion_id)
            ->select([
                'inscripciones.id',
                'grupo_id',
                'matricula_id',
                'grupos.sucursal as grupo_sucursal',
            ])
            ->join('grupos', 'inscripciones.grupo_id', '=', 'grupos.id')
            ->latest('inscripciones.id')
            ->first();
    }

    //Obtener inscripcion para crear nota
    public static function create_nota($inscripcion_id)
    {
        return DB::table('inscripciones')
            ->where('inscripciones.id', $inscripcion_id)
            ->select([
                'inscripciones.*',
                'grupos.curso_id as curso_id',
            ])
            ->join('grupos', 'inscripciones.grupo_id', '=', 'grupos.id')
            ->first();
    }

    public static function grupos($matricula_id)
    {
        return DB::table('inscripciones')
            ->where('matricula_id', $matricula_id)
            ->select([
                'grupos.id as id',
                'cursos.nombre as nombre',
            ])
            ->join('grupos', 'inscripciones.grupo_id', '=', 'grupos.id')
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->get();
    }

    // RELACIONES
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
