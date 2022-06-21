<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    //Obtener ultimo mes pagado
    public static function lastMonth($id)
    {
        return Pago::inscripcion($id)
            ->where('tipo', '1')
            ->get('concepto')
            ->last();
    }

    //Cargar Pagos de 1 Inscripcion
    public static function loadThis($id)
    {
        return Pago::inscripcion($id)->get();
    }

    /* SCOPES */
    public function scopeInscripcion($q, $id)
    {
        return $q->where('inscripcion_id', $id);
    }

    public function setConceptoAttribute($value)
    {
        $this->attributes['concepto'] = trim(strtoupper($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
