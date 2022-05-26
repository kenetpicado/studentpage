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

    public static function getToReport($grupo_id)
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

    public static function getByGrupo($grupo_id)
    {
        return Inscripcion::where('grupo_id', $grupo_id)
            ->with('matricula:id,carnet,nombre')
            ->get();
    }

    public static function loadThisWith($grupo_id, $matricula_id, $with)
    {
        return Inscripcion::where('grupo_id', $grupo_id)
            ->where('matricula_id', $matricula_id)
            ->with($with)
            ->first();
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
