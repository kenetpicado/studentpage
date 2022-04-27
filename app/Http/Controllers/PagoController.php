<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\Grupo;
use App\Models\Matricula;
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
        //
        $matricula = Matricula::with('pagos:id,created_at,recibo,monto,concepto,matricula_id')
            ->find($matricula_id, ['id', 'nombre']);

        return view('pago.index', compact('matricula', 'grupo_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoRequest $request)
    {
        //Si es de tipo mensualidad
        if ($request->tipo == '1') {

            $request->validate([
                'monto' => 'required|numeric|gt:0',
                'recibo' => 'required',
            ]);


            //Obtener el ultimo mes registrado
            $ultimo = Pago::where('matricula_id', $request->matricula_id)->where('tipo', '1')->get('concepto')->last();

            if ($ultimo == null) {
                $mes = $this->generar_mes('');
            } else {
                $mes = $this->generar_mes($ultimo->concepto);
            }

            //Agregar al request
            $request->merge(['concepto' => $mes]);
        } else {
            //Si es tipo otro validar el campo extra
            $request->validate([
                'concepto' => 'required|max:50',
                'monto' => 'required|numeric|gt:0',
                'recibo' => 'required',
            ]);
        }

        Pago::create($request->all());
        return back();
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
}
