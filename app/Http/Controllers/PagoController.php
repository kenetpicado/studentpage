<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\GrupoMatricula;
use App\Models\Pago;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    //Cargar vista de los pagos
    public function pagar($matricula_id, $grupo_id)
    {
        //Obtener el grupo en la tabla pivot
        $pivot = GrupoMatricula::where('grupo_id', $grupo_id)
            ->where('matricula_id', $matricula_id)
            ->with('pagos:id,created_at,recibo,monto,concepto,grupo_matricula_id')
            ->with('matricula:id,nombre')
            ->first(['id', 'matricula_id']);

        return view('pago.index', compact('pivot', 'grupo_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoRequest $request)
    {
        //Obtener el ultimo mes registrado
        $ultimo = Pago::where('grupo_matricula_id', $request->grupo_matricula_id)->where('tipo', '1')->get('concepto')->last();

        //SI es mensualidad
        if ($request->tipo == '1') {
            if ($ultimo == null) {
                $meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
                $mes = $meses[date('n') - 1];
            } else {
                $mes = $this->generar_mes($ultimo->concepto);
            }
            //Agregar al request
            $request->merge(['concepto' => $mes]);
        }

        Pago::create($request->all());
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePagoRequest  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
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
