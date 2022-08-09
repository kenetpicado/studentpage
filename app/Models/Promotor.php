<?php

namespace App\Models;

use App\Casts\Lower;
use App\Casts\Ucwords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotor extends Model
{
    use HasFactory;

    protected $fillable = ['carnet', 'nombre', 'correo'];
    public $timestamps = false;

    protected $casts = [
        'nombre' => Ucwords::class,
        'correo' => Lower::class,
    ];

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}
