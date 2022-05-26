<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripcion;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['unidad', 'valor', 'inscripcion_id'];
    public $timestamps = false;

    public static function loadThis($inscripcion_id)
    {
        return Nota::where('inscripcion_id', $inscripcion_id)
            ->orderBy('unidad')
            ->get(['id', 'unidad', 'valor']);
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }

    public function setUnidadAttribute($value)
    {
        $this->attributes['unidad'] = trim(strtoupper($value));
    }
}
