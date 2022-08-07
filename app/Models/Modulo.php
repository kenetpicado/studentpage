<?php

namespace App\Models;

use App\Casts\Upper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota;

class Modulo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre', 'curso_id'];

    protected $casts = [
        'nombre' => Upper::class,
    ];

    // RELACIONES
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
