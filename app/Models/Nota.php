<?php

namespace App\Models;

use App\Casts\Ucwords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Modulo;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['modulo_id', 'valor', 'inscripcion_id', 'created_at'];
    public $timestamps = false;

    protected $casts = [
        'materia' => Ucwords::class,
    ];

    public static function index($inscripcion_id)
    {
        return DB::table('notas')
            ->where('notas.inscripcion_id', $inscripcion_id)
            ->select([
                'notas.*',
                'modulos.nombre as modulo_nombre',
            ])
            ->join('modulos', 'notas.modulo_id', '=', 'modulos.id')
            ->get();
    }

    public static function edit($nota_id)
    {
        return DB::table('notas')
            ->where('notas.id', $nota_id)
            ->select([
                'notas.*',
                'modulos.id as modulo_id',
                'modulos.curso_id as curso_id',
                'inscripciones.grupo_id as grupo_id'
            ])
            ->join('inscripciones', 'notas.inscripcion_id', '=', 'inscripciones.id')
            ->join('modulos', 'notas.modulo_id', '=', 'modulos.id')
            ->first();
    }

    public static function getByInscripcion($inscripcion_id)
    {
        return DB::table('notas')
            ->where('inscripcion_id', $inscripcion_id)
            ->select([
                'notas.*',
                'modulos.nombre as modulo'
            ])
            ->join('modulos', 'notas.modulo_id', '=', 'modulos.id')
            ->get();
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
