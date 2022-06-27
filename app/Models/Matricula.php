<?php

namespace App\Models;

use App\Casts\dmY;
use App\Casts\Ucfirst;
use App\Casts\Ucwords;
use App\Casts\Upper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Promotor;
use App\Models\Inscripcion;
use App\Traits\ScopesTraits;

class Matricula extends Model
{
    use HasFactory, ScopesTraits;

    protected $fillable = [
        'nombre',
        'cedula',
        'fecha_nac',
        'celular',
        'tutor',
        'grado',
        'carnet',
        'pin',
        'sucursal',
        'promotor_id',
        'created_at'
    ];

    public $timestamps = false;

    protected $casts = [
        'nombre' => Ucwords::class,
        'tutor' => Ucwords::class,
        'grado' => Ucfirst::class,
        'cedula' => Upper::class,
        'carnet' => Upper::class,
        'pin' => Upper::class,
        'created_at' => dmY::class,
    ];

    //Todas las Matriculas de sucursal
    public static function getMatriculasSucursal()
    {
        return Matricula::sucursal(auth()->user()->sucursal)
            ->attributes()
            ->countInscripciones()
            ->get();
    }

    //Matriculas de un Promotor (Index)
    public static function getMatriculasPromotor($promotor_id)
    {
        return Matricula::wherePromotor($promotor_id)
            ->attributes()
            ->countInscripciones()
            ->get();
    }

    //Matriculas de un Promotor (Show)
    public static function toPromotorShow($promotor_id)
    {
        if (auth()->user()->sucursal == 'all')
            return Matricula::wherePromotor($promotor_id)
                ->attributes()
                ->countInscripciones()
                ->get();

        return Matricula::wherePromotor($promotor_id)
            ->sucursal(auth()->user()->sucursal)
            ->attributes()
            ->countInscripciones()
            ->get();
    }

    //Obtener todas las Matriculas
    public static function getMatriculas()
    {
        return Matricula::attributes()
            ->countInscripciones()
            ->get();
    }

    public function scopeAttributes($q)
    {
        return $q->select(['id', 'nombre', 'carnet', 'created_at', 'promotor_id'])->orderBy('id', 'desc');
    }

    public function promotor()
    {
        return $this->belongsTo(Promotor::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
