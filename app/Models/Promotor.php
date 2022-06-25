<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matricula;
use Illuminate\Support\Facades\DB;

class Promotor extends Model
{
    use HasFactory;

    protected $fillable = ['carnet', 'nombre', 'correo'];
    public $timestamps = false;

    //Obtener todos los Promotores
    public static function getPromotores()
    {
        return Promotor::orderBy('nombre')->get();
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(ucwords(strtolower($value)));
    }

    public function setCorreoAttribute($value)
    {
        $this->attributes['correo'] = trim(strtolower($value));
    }

    //Releacion 1:n a Matriculas
    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}
