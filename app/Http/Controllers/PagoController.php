<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Models\Inscripcion;
use App\Models\Pago;
use Illuminate\Support\Facades\Gate;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Cargar vista de los pagos
    public function create($matricula_id, $grupo_id)
    {
        Gate::authorize('admin');
        $inscripcion = Inscripcion::loadThisWith($grupo_id, $matricula_id, 'pagos');
        return view('pago.index', compact('inscripcion', 'grupo_id'));
    }

    //Guardar pago
    public function store(StorePagoRequest $request)
    {
        Gate::authorize('admin');

        if ($request->tipo == '1') {
            $ultimo = Pago::lastMonth($request->inscripcion_id);
            if ($ultimo == null) {
                $mes = $this->current_month();
            } else {
                $mes = $this->generar_mes($ultimo->concepto);
            }

            $request->merge(['concepto' => $mes]);
        }

        Pago::create($request->all());
        return back();
    }

    public function current_month()
    {
        $meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
        return $meses[date('n') - 1];
    }

    public function generar_mes($value)
    {
        switch ($value) {
            case '':
                return 'ENERO';
                break;
            case 'ENERO':
                return 'FEBRERO';
                break;
            case 'FEBRERO':
                return 'MARZO';
                break;
            case 'MARZO':
                return 'ABRIL';
                break;
            case 'ABRIL':
                return 'MAYO';
                break;
            case 'MAYO':
                return 'JUNIO';
                break;
            case 'JUNIO':
                return 'JULIO';
                break;
            case 'JULIO':
                return 'AGOSTO';
                break;
            case 'AGOSTO':
                return 'SEPTIEMBRE';
                break;
            case 'SEPTIEMBRE':
                return 'OCTUBRE';
                break;
            case 'OCTUBRE':
                return 'NOVIEMBRE';
                break;
            case 'NOVIEMBRE':
                return 'DICIEMBRE';
                break;
            default:
                return 'ENERO';
                break;
        }
    }
}
