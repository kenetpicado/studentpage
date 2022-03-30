<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prematricula;
use App\Models\Pago;
use App\Models\Grupo;

class Matricula extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function prematricula() 
    {
        return $this->belongsTo(Prematricula::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
    public function grupo() 
    {
        return $this->belongsTo(Grupo::class);
    }
}
