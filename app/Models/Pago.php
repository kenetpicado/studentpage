<?php

namespace App\Models;

use App\Casts\dmY;
use App\Casts\Upper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto',
        'moneda',
        'saldo',
        'concepto',
        'matricula_id',
        'grupo_id',
        'created_at',
    ];

    public $timestamps = false;

    protected $casts = [
        'concepto' => Upper::class,
        'created_at' => dmY::class,
    ];
    
    /**
     * Obtener todos los pagos de un alumno
     *
     * @param  int $matricula_id
     * @return Collection
     */
    public static function index($matricula_id)
    {
        return DB::table('pagos')
            ->where('matricula_id', $matricula_id)
            ->latest('id')
            ->paginate(20);
    }
    
    /**
     * Obtener informacion de un pago
     * Para generar un recibo
     *
     * @param  int $pago_id
     * @return Collection
     */
    public static function recibo($pago_id)
    {
        return DB::table('pagos')
            ->where('pagos.id', $pago_id)
            ->leftjoin('grupos', 'pagos.grupo_id', '=', 'grupos.id')
            ->leftjoin('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->leftjoin('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->first([
                'pagos.*',
                'grupos.horario as horario',
                'cursos.nombre as curso',
                'docentes.nombre as docente',
            ]);
    }
}
