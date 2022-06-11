<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'activo'];
    public $timestamps = false;

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(ucwords(strtolower($value)));
    }

    //Releacion 1:n a Grupos
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    //Obtener todos los Cursos
    public static function getCursos()
    {
        return Curso::orderAsc()->get();
    }

    //Obtener los Cursos activos
    public static function getCursosActivos()
    {
        return Curso::where('activo', '1')->orderAsc()->get(['id', 'nombre']);
    }

    /* SCOPES */
    public function scopeOrderAsc($q)
    {
        return $q->orderBy('nombre', 'asc');
    }
}
