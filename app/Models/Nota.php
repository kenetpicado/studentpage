<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoMatricula;

class Nota extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setUnidadAttribute($value)
    {
        $this->attributes['unidad'] = trim(strtoupper($value));
    }

    //
    public function grupomatricula()
    {
        return $this->belongsTo(GrupoMatricula::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
