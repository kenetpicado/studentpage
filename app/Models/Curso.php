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

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(ucwords(strtolower($value)));
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public static function getCursos()
    {
        return Curso::orderBy('id', 'desc')
            ->get();;
    }

    public static function getCursosActivos()
    {
        return Curso::where('activo', '1')->get(['id', 'nombre']);
    }
}
