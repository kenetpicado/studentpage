<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public static function lastMonth($inscripcion_id)
    {
        return Pago::where('inscripcion_id', $inscripcion_id)
            ->where('tipo', '1')
            ->get('concepto')
            ->last();
    }

    public static function loadThis($inscripcion_id)
    {
        return Pago::where('inscripcion_id', $inscripcion_id)
            ->get(['id', 'concepto', 'monto', 'created_at']);
    }

    public function setConceptoAttribute($value)
    {
        $this->attributes['concepto'] = trim(strtoupper($value));
    }
}
