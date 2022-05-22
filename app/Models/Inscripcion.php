<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota;
use App\Models\Pago;
use App\Models\Matricula;
use App\Models\Grupo;

class Inscripcion extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['grupo_id', 'matricula_id'];

    protected $table = "inscripciones";

    public static function getByGrupo($grupo_id)
    {
        return Inscripcion::where('grupo_id', $grupo_id)
            ->with('matricula:id,carnet,nombre')
            ->get();
    }

    public static function loadWithGrupo($grupo_id, $matricula_id)
    {
        return Inscripcion::where('grupo_id', $grupo_id)
            ->where('matricula_id', $matricula_id)
            ->with('grupo:id,sucursal')
            ->first();
    }

    public static function loadWithNotas($grupo_id, $matricula_id)
    {
        return Inscripcion::where('grupo_id', $grupo_id)
            ->where('matricula_id', $matricula_id)
            ->with('notas')
            ->first();
    }

    public static function loadWithPagos($grupo_id, $matricula_id)
    {
        return Inscripcion::where('grupo_id', $grupo_id)
            ->where('matricula_id', $matricula_id)
            ->with('pagos')
            ->first();
    }

    public static function loadForReport($grupo_id)
    {
        return Inscripcion::where('grupo_id', $grupo_id)
            ->with([
                'notas' => function ($query) {
                    $query->select('id', 'unidad', 'valor', 'inscripcion_id')->orderBy('unidad');
                }
            ])
            ->with('matricula:id,nombre,carnet')
            ->get();
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
