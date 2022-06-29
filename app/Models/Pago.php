<?php

namespace App\Models;

use App\Casts\dmY;
use App\Casts\Ucfirst;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto',
        'recibo',
        'concepto',
        'inscripcion_id',
        'created_at',
    ];
    
    public $timestamps = false;

    protected $casts = [
        'concepto' => Ucfirst::class,
        'created_at' => dmY::class,
    ];

    public static function forEdit($pago_id)
    {
        return DB::table('pagos')
            ->where('pagos.id', $pago_id)
            ->select([
                'pagos.*',
                'inscripciones.grupo_id as grupo_id'
            ])
            ->join('inscripciones', 'pagos.inscripcion_id', '=', 'inscripciones.id')
            ->first();
    }
    
    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }
}
