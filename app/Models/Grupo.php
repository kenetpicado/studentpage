<?php

namespace App\Models;

use App\Casts\Upper;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'horario' => Upper::class,
    ];

    public static function index($activo = '1')
    {
        switch (true) {

            case (auth()->user()->rol == 'docente'):
                return DB::table('grupos')
                    ->where('grupos.activo', $activo)
                    ->where('grupos.docente_id', auth()->user()->sub_id)
                    ->select([
                        'grupos.id',
                        'horario',
                        'anyo',
                        'grupos.sucursal',
                        'cursos.nombre as curso_nombre',
                        'docentes.nombre as docente_nombre',
                    ])
                    ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
                    ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
                    ->latest('grupos.id')
                    ->orderBy('sucursal')
                    ->get();
                break;

            case (auth()->user()->sucursal != 'all'):
                return DB::table('grupos')
                    ->where('grupos.activo', $activo)
                    ->where('grupos.sucursal', auth()->user()->sucursal)
                    ->select([
                        'grupos.id',
                        'horario',
                        'anyo',
                        'grupos.sucursal',
                        'cursos.nombre as curso_nombre',
                        'docentes.nombre as docente_nombre',
                    ])
                    ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
                    ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
                    ->latest('grupos.id')
                    ->orderBy('sucursal')
                    ->get();
                break;

            default:
                return DB::table('grupos')
                    ->where('grupos.activo', $activo)
                    ->select([
                        'grupos.id',
                        'horario',
                        'anyo',
                        'grupos.sucursal',
                        'cursos.nombre as curso_nombre',
                        'docentes.nombre as docente_nombre',
                    ])
                    ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
                    ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
                    ->latest('grupos.id')
                    ->orderBy('sucursal')
                    ->get();
                break;
        }
    }

    //Obtener grupo para reporte de notas
    public static function reporte($grupo_id)
    {
        return DB::table('grupos')
            ->where('grupos.id', $grupo_id)
            ->select([
                'grupos.id',
                'horario',
                'grupos.sucursal',
                'anyo',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
            ])
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->first();
    }

    //Grupos para crear y editar Inscripcion
    public static function inscripcion($sucursal)
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

    //ver grupos de 1 Docente
    public static function docente($docente_id)
    {
        return DB::table('grupos')
            ->where('docente_id', $docente_id)
            ->where('grupos.activo', '1')
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

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
