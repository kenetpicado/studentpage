<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota;
use App\Models\Pago;
use App\Models\Matricula;
use App\Models\Grupo;

class GrupoMatricula extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'grupo_id',
        'matricula_id',
    ];

    protected $table = "grupo_matricula";

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    //
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
