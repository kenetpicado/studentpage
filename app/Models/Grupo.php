<?php

namespace App\Models;

use App\Casts\Upper;
use App\Models\Inscripcion;
use App\Traits\rolesTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    use HasFactory;
    use rolesTraits;

    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'horario' => Upper::class,
    ];

    /**
     * Mostrar todos los Grupos
     *
     * @param  int $activo
     * @return Collection
     */
    public static function index($activo = 1)
    {
        return DB::table('grupos')
            ->where('grupos.activo', $activo)
            ->when(Grupo::esDocente(), function ($q) {
                $q->where('grupos.docente_id', auth()->user()->sub_id);
            })
            ->when(Grupo::adminSucursal(), function ($q) {
                $q->where('grupos.sucursal', auth()->user()->sucursal);
            })
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->latest('grupos.id')
            ->orderBy('sucursal')
            ->select([
                'grupos.id',
                'horario',
                'anyo',
                'grupos.sucursal',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
            ])
            ->paginate(20);
    }

    /**
     * Obtener grupo para reporte de notas
     *
     * @param  int $grupo_id
     * @return object
     */
    public static function reporte($grupo_id)
    {
        return DB::table('grupos')
            ->where('grupos.id', $grupo_id)
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->first([
                'grupos.id',
                'horario',
                'grupos.sucursal',
                'anyo',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
            ]);
    }

    /**
     * Obtener Grupos para crear 
     * y editar Inscripcion
     *
     * @param  string $sucursal
     * @return Collection
     */
    public static function inscripcion($sucursal)
    {
        return DB::table('grupos')
            ->where('grupos.sucursal', $sucursal)
            ->where('grupos.activo', '1')
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->latest('grupos.id')
            ->get([
                'grupos.id',
                'horario',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
            ]);
    }

    /**
     * Obtener grupos de un docente
     *
     * @param  int $docente_id
     * @return Collection
     */
    public static function docente($docente_id)
    {
        return DB::table('grupos')
            ->where('docente_id', $docente_id)
            ->where('grupos.activo', '1')
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->orderBy('cursos.nombre')
            ->select([
                'grupos.horario',
                'grupos.sucursal',
                'grupos.anyo',
                'cursos.nombre as curso_nombre'
            ])
            ->paginate(20);
    }

    public static function showThis($grupo_id)
    {
        return DB::table('grupos')
            ->where('grupos.id', $grupo_id)
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->first([
                'grupos.id',
                'grupos.horario',
                'cursos.nombre',
                'cursos.id as curso_id'
            ]);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
