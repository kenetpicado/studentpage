<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoMatricula;

class Pago extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setConceptoAttribute($value)
    {
        $this->attributes['concepto'] = trim(strtoupper($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
