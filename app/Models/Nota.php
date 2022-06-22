<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripcion;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['num', 'materia', 'valor', 'inscripcion_id'];
    public $timestamps = false;

    //Cargar Notas de 1 Inscripcion
    public static function loadThis($inscripcion_id)
    {
        return Nota::where('inscripcion_id', $inscripcion_id)->orderBy('num')->get();
    }

    // RELACIONES
    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }

    public function setMateriaAttribute($value)
    {
        $this->attributes['materia'] = trim(ucwords(strtolower($value)));
    }
}
