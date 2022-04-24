<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota;

class GrupoMatricula extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = "grupo_matricula";

    //
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
