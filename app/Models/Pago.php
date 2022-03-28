<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matricula;

class Pago extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['monto', 'concepto', 'matricula_id'];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function setConceptoAttribute($value)
    {
        $this->attributes['concepto'] = trim(strtoupper($value));
    }
}
