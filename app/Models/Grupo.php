<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\DB;

class Grupo extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    //Obtener grupo para reporte de notas
    public static function getToReport($grupo_id)
    {
        return DB::table('grupos')
            ->where('grupos.id', $grupo_id)
            ->select([
                'grupos.id',
                'horario',
                'grupos.sucursal',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
            ])
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->first();
    }

    //Grupos para crear y editar Inscripcion
    public static function getForInscripciones($sucursal)
    {
        return DB::table('grupos')
            ->where('grupos.sucursal', $sucursal)
            ->where('grupos.activo', '1')
            ->select([
                'grupos.id',
                'horario',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
            ])
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->latest('grupos.id')
            ->get();
    }

    //Grupos de 1 Sucursal
    public static function getGruposSucursal($activo = '1')
    {
        return DB::table('grupos')
            ->where('grupos.sucursal', auth()->user()->sucursal)
            ->where('grupos.activo', $activo)
            ->select([
                'grupos.id',
                'horario',
                'anyo',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
                DB::raw('(select count(*) from `inscripciones` where `grupos`.`id` = `inscripciones`.`grupo_id`) as `inscripciones_count`')
            ])
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->latest('grupos.id')
            ->get();
    }

    //Grupos de 1 Docente
    public static function getGruposDocente($docente_id, $activo = '1')
    {
        return DB::table('grupos')
            ->where('grupos.docente_id', $docente_id)
            ->where('grupos.activo', $activo)
            ->select([
                'grupos.id',
                'horario',
                'anyo',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
                DB::raw('(select count(*) from `inscripciones` where `grupos`.`id` = `inscripciones`.`grupo_id`) as `inscripciones_count`')
            ])
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->latest('grupos.id')
            ->get();
    }

    //ver grupos de 1 Docente
    public static function getGruposDocenteShow($docente_id, $activo = '1')
    {
        return DB::table('grupos')->where('docente_id', $docente_id)
            ->where('grupos.activo', $activo)
            ->select([
                'grupos.horario',
                'grupos.sucursal',
                'grupos.anyo',
                'cursos.nombre as curso_nombre'
            ])
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->orderBy('cursos.nombre')
            ->get();
    }

    //Obtener todos los Grupos
    public static function getGrupos($activo = '1')
    {
        return DB::table('grupos')
            ->where('grupos.activo', $activo)
            ->select([
                'grupos.id',
                'horario',
                'anyo',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
                DB::raw('(select count(*) from `inscripciones` where `grupos`.`id` = `inscripciones`.`grupo_id`) as `inscripciones_count`')
            ])
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->latest('grupos.id')
            ->get();
    }

    //Cambiar estado del grupo
    public static function status($grupo_id, $activo = '1')
    {
        Grupo::find($grupo_id, ['id', 'activo'])->update(['activo' => $activo]);
    }

    //
    public static function edit($grupo_id)
    {
        return DB::table('grupos')
            ->select(['id', 'docente_id', 'horario', 'sucursal'])
            ->find($grupo_id);
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
