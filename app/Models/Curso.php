<?php

namespace App\Models;

use App\Casts\Ucwords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'activo'];
    public $timestamps = false;

    protected $casts = [
        'nombre' => Ucwords::class,
    ];

    //Obtener todos los Cursos
    public static function getCursos()
    {
        return DB::table('cursos')->orderBy('nombre')->get();
    }

    //Obtener los Cursos activos
    public static function getCursosActivos()
    {
        return DB::table('cursos')->where('activo', '1')->orderBy('nombre')->get(['id', 'nombre']);
    }

    //Releacion 1:n a Grupos
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
