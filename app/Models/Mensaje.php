<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mensaje extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['from', 'contenido', 'created_at', 'enlace', 'grupo_id'];
    
    /**
     * Obtener los mensajes de un Grupo
     *
     * @param  int $grupo_id
     * @return Collection
     */
    public static function getByGrupo($grupo_id)
    {
        return DB::table('mensajes')
            ->where('grupo_id', $grupo_id)
            ->orWhere('grupo_id', null)
            ->latest('id')
            ->paginate(10);
    }
}
