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

    public static function getByGrupo($grupo_id)
    {
        return DB::table('mensajes')->where('grupo_id', $grupo_id)->latest('id')->get();
    }
}
