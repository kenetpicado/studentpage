<?php

namespace App\Models;

use App\Casts\Ucwords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripcion;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['num', 'materia', 'valor', 'inscripcion_id'];
    public $timestamps = false;

    protected $casts = [
        'materia' => Ucwords::class,
    ];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }
}
