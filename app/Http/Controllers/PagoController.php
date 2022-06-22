<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Models\Inscripcion;
use App\Models\Pago;
use Carbon\Carbon;

class PagoController extends Controller
{
    //Cargar vista de los pagos
    public function index(Inscripcion $inscripcion)
    {
        $inscripcion->load('pagos');
        return view('pago.index', compact('inscripcion'));
    }

    //Guardar pago
    public function store(StorePagoRequest $request)
    {
        if ($request->tipo == '1') {
            $ultimo = Pago::lastMonth($request->inscripcion_id);
            if ($ultimo == null) {
                $mes = $this->current_month();
            } else {
                $mes = $this->generar_mes($ultimo->concepto);
            }

            $request->merge(['concepto' => $mes]);
        }

        $request->merge([
            'created_at' => Carbon::now()->format('Y-m-d')
        ]);

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
