<?php

namespace App\Models;

use App\Casts\dmY;
use App\Casts\Upper;
use App\Casts\Ucfirst;
use App\Casts\Ucwords;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function index()
    {
        switch (true) {

            case (auth()->user()->rol == 'promotor'):
                return DB::table('matriculas')
                    ->where('promotor_id', auth()->user()->sub_id)
                    ->select([
                        'id',
                        'carnet',
                        'nombre',
                        'created_at',
                        'activo',
                        'sucursal',
                        DB::raw('(select count(*) from inscripciones where matriculas.id = inscripciones.matricula_id) as inscripciones_count')
                    ])
                    ->latest('id')
                    ->get();
                break;

            case (auth()->user()->rol == 'admin' && auth()->user()->sucursal != 'all'):
                return DB::table('matriculas')
                    ->where('sucursal', auth()->user()->sucursal)
                    ->select([
                        'id',
                        'carnet',
                        'nombre',
                        'created_at',
                        'activo',
                        'sucursal',
                        DB::raw('(select count(*) from inscripciones where matriculas.id = inscripciones.matricula_id) as inscripciones_count')
                    ])
                    ->latest('id')
                    ->get();
                break;

            default:
                return DB::table('matriculas')
                    ->select([
                        'id',
                        'carnet',
                        'nombre',
                        'created_at',
                        'activo',
                        'sucursal',
                        DB::raw('(select count(*) from inscripciones where matriculas.id = inscripciones.matricula_id) as inscripciones_count')
                    ])
                    ->latest('id')
                    ->get();
                break;
        }
    }

    //Matriculas de un Promotor (Show)
    public static function promotor($promotor_id)
    {
        if (auth()->user()->sucursal == 'all')
            return DB::table('matriculas')
                ->where('promotor_id', $promotor_id)
                ->select([
                    'id',
                    'carnet',
                    'nombre',
                    'created_at',
                    'activo',
                    'sucursal',
                    'promotor_id',
                    DB::raw('(select count(*) from inscripciones where matriculas.id = inscripciones.matricula_id) as inscripciones_count')
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
                'activo',
                'sucursal',
                DB::raw('(select count(*) from inscripciones where matriculas.id = inscripciones.matricula_id) as inscripciones_count')
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
