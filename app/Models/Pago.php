<?php

namespace App\Models;

use App\Casts\dmY;
use App\Casts\Ucfirst;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }
}
