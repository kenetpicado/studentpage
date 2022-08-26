<?php

namespace App\Models;

use App\Casts\dmY;
use App\Casts\Upper;
use App\Casts\Ucfirst;
use App\Casts\Ucwords;
use App\Models\Inscripcion;
use App\Traits\rolesTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matricula extends Model
{
    use HasFactory;
    use rolesTraits;

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
        'created_at',
        'inasistencias'
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

    public static function index()
    {
        return DB::table('matriculas')
            ->when(Matricula::esPromotor(), function ($q) {
                $q->where('promotor_id', auth()->user()->sub_id);
            })
            ->when(Matricula::adminSucursal(), function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->latest('id')
            ->get([
                'id',
                'carnet',
                'nombre',
                'created_at',
                'activo',
                'sucursal',
                DB::raw('(select count(*) from inscripciones where matriculas.id = inscripciones.matricula_id) as inscripciones_count')
            ]);
    }


    /**
     * Obtener matriculas de un promotor
     *
     * @param  int $promotor_id
     * @return Collection
     */
    public static function promotor($promotor_id)
    {
        return DB::table('matriculas')
            ->when(Matricula::enSucursal(), function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->where('promotor_id', $promotor_id)
            ->latest('id')
            ->get([
                'id',
                'carnet',
                'nombre',
                'created_at',
                'activo',
                'sucursal',
                'promotor_id',
                DB::raw('(select count(*) from inscripciones where matriculas.id = inscripciones.matricula_id) as inscripciones_count')
            ]);
    }

    public static function buscar($request)
    {
        return DB::table('matriculas')
            ->when(Matricula::enSucursal(), function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->where('carnet', 'LIKE', '%' . $request->buscar . '%')
            ->orWhere('nombre', 'LIKE', '%' . $request->buscar . '%')
            ->get(['id', 'nombre', 'carnet']);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
