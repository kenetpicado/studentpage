<?php

namespace App\Models;

use App\Casts\Ucwords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['modulo_id', 'valor', 'inscripcion_id'];
    public $timestamps = false;

    protected $casts = [
        'materia' => Ucwords::class,
    ];

    public static function forEdit($nota_id)
    {
        return DB::table('notas')
            ->where('notas.id', $nota_id)
            ->select([
                'notas.*',
                'inscripciones.grupo_id as grupo_id'
            ])
            ->join('inscripciones', 'notas.inscripcion_id', '=', 'inscripciones.id')
            ->first();
    }
    
    public static function getByInscripcion($inscripcion_id)
    {
        return DB::table('notas')
            ->where('inscripcion_id', $inscripcion_id)
            ->orderBy('num')
            ->get();
    }
}
