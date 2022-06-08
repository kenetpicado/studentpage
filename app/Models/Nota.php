<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripcion;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['num', 'materia', 'valor', 'inscripcion_id', 'created_at'];
    public $timestamps = false;

    public static function loadThis($inscripcion_id)
    {
        return Nota::where('inscripcion_id', $inscripcion_id)
            ->orderBy('num')
            ->get(['id', 'num', 'materia', 'valor']);
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }

    public function setMateriaAttribute($value)
    {
        $this->attributes['materia'] = trim(ucwords(strtolower($value)));
    }
}
