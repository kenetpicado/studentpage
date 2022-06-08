<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matricula;

class Promotor extends Model
{
    use HasFactory;

    protected $fillable = ['carnet', 'nombre', 'correo'];
    public $timestamps = false;

    public static function loadThis($promotor_id)
    {
        return Promotor::find($promotor_id, ['id', 'nombre']);
    }

    //Obtener todos los promotores
    public static function getPromotores()
    {
        return Promotor::orderBy('id', 'desc')->get();
    }

    public static function getPromotor($promotor_id)
    {
        return Promotor::withCount('matriculas')->find($promotor_id);
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(ucwords(strtolower($value)));
    }

    public function setCorreoAttribute($value)
    {
        $this->attributes['correo'] = trim(strtolower($value));
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}
