<?php

namespace App\Models;

use App\Casts\dmY;
use App\Casts\Ucfirst;
use App\Casts\Ucwords;
use App\Casts\Upper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\DB;

class Matricula extends Model
{
    use HasFactory;

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
        'activo',
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
        return DB::table('matriculas')
            ->where('sucursal', auth()->user()->sucursal)
            ->select([
                'id',
                'carnet',
                'nombre',
                'created_at',
                'promotor_id',
                DB::raw('(select count(*) from `inscripciones` where `matriculas`.`id` = `inscripciones`.`matricula_id`) as `inscripciones_count`')
            ])
            ->latest('id')
            ->get();
    }

    //Matriculas de un Promotor (Index)
    public static function getMatriculasPromotor($promotor_id)
    {
        return DB::table('matriculas')
            ->where('promotor_id', $promotor_id)
            ->select([
                'id',
                'carnet',
                'nombre',
                'created_at',
                'promotor_id',
                DB::raw('(select count(*) from `inscripciones` where `matriculas`.`id` = `inscripciones`.`matricula_id`) as `inscripciones_count`')
            ])
            ->latest('id')
            ->get();
    }

    //Matriculas de un Promotor (Show)
    public static function toPromotorShow($promotor_id)
    {
        if (auth()->user()->sucursal == 'all')
            return DB::table('matriculas')
                ->where('promotor_id', $promotor_id)
                ->select([
                    'id',
                    'carnet',
                    'nombre',
                    'created_at',
                    'promotor_id',
                    DB::raw('(select count(*) from `inscripciones` where `matriculas`.`id` = `inscripciones`.`matricula_id`) as `inscripciones_count`')
                ])
                ->latest('id')
                ->get();

        return DB::table('matriculas')
            ->where('promotor_id', $promotor_id)
            ->where('sucursal', auth()->user()->sucursal)
            ->select([
                'id',
                'carnet',
                'nombre',
                'created_at',
                'promotor_id',
                DB::raw('(select count(*) from `inscripciones` where `matriculas`.`id` = `inscripciones`.`matricula_id`) as `inscripciones_count`')
            ])
            ->latest('id')
            ->get();
    }

    //Obtener todas las Matriculas
    public static function getMatriculas()
    {
        return DB::table('matriculas')
            ->select([
                'id',
                'carnet',
                'nombre',
                'created_at',
                'promotor_id',
                DB::raw('(select count(*) from `inscripciones` where `matriculas`.`id` = `inscripciones`.`matricula_id`) as `inscripciones_count`')
            ])
            ->latest('id')
            ->get();
    }

    public static function buscar($request)
    {
        return auth()->user()->sucursal == 'all'
            ? DB::table('matriculas')
            ->where('carnet', 'LIKE', '%' . $request->buscar . '%')
            ->orWhere('nombre', 'LIKE', '%' . $request->buscar . '%')
            ->select(['id', 'nombre', 'carnet'])
            ->get()
            : DB::table('matriculas')
            ->where('sucursal', auth()->user()->sucursal)
            ->where('carnet', 'LIKE', '%' . $request->buscar . '%')
            ->orWhere('nombre', 'LIKE', '%' . $request->buscar . '%')
            ->select(['id', 'nombre', 'carnet'])
            ->get();
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
