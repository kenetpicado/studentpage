<?php

namespace App\Models;

use App\Casts\dmY;
use App\Casts\Upper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function index($matricula_id)
    {
        return DB::table('pagos')->where('matricula_id', $matricula_id)->latest('id')->get();
    }

    public static function forEdit($pago_id)
    {
        return DB::table('pagos')
            ->where('pagos.id', $pago_id)
            ->select([
                'pagos.*',
                'matriculas.grupo_id as grupo_id',
            ])
            ->join('matriculas', 'pagos.matricula_id', '=', 'matriculas.id')
            ->first();
    }

    public static function recibo($pago_id)
    {
        return DB::table('pagos')
            ->where('pagos.id', $pago_id)
            ->select([
                'pagos.*',
                'grupos.horario as horario',
                'cursos.nombre as curso',
                'docentes.nombre as docente',
                'grupos.sucursal as sucursal',
                'matriculas.nombre as nombre'
            ])
            ->leftjoin('grupos', 'pagos.grupo_id', '=', 'grupos.id')
            ->leftjoin('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->leftjoin('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->leftjoin('matriculas', 'pagos.matricula_id', '=', 'matriculas.id')
            ->first();
    }
}
