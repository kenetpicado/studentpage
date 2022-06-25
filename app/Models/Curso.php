<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'activo'];
    public $timestamps = false;

    //Obtener todos los Cursos
    public static function getCursos()
    {
        return Curso::orderBy('nombre')->get();
    }

    //Obtener los Cursos activos
    public static function getCursosActivos()
    {
        return Curso::where('activo', '1')
            ->orderBy('nombre')
            ->get(['id', 'nombre']);
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(ucwords(strtolower($value)));
    }

    //Releacion 1:n a Grupos
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
