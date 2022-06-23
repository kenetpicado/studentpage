<?php

namespace App\Models;

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

    public function setConceptoAttribute($value)
    {
        $this->attributes['concepto'] = trim(ucfirst(strtolower($value)));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
    
    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }
}
