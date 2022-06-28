<?php

namespace App\Models;

use App\Casts\Ucwords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;
use App\Traits\ScopesTraits;

class Curso extends Model
{
    use HasFactory, ScopesTraits;

    protected $fillable = ['nombre', 'activo'];
    public $timestamps = false;

    protected $casts = [
        'nombre' => Ucwords::class,
    ];

    //Obtener todos los Cursos
    public static function getCursos()
    {
        return Curso::orderNombre()->get();
    }

    //Obtener los Cursos activos
    public static function getCursosActivos()
    {
        return Curso::activo()->orderNombre()->get(['id', 'nombre']);
    }

    //Releacion 1:n a Grupos
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
