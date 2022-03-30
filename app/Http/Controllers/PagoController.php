<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\Matricula;
use App\Models\Pago;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagos = Pago::all();
        return view('pago.index', compact('pagos', $pagos))->with('status', 'Se muestran los pagos de TODOS los alumnos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //MUESTRA TABLA CON TODAS LAS MATRICULAS
        //DIPONIBLES PARA REALIZAR UN PAGO
        $matriculas = Matricula::all();
        return view('pago.create', compact('matriculas', $matriculas));
    }

    public function pagar(Matricula $matricula)
    {
        //MOSTRAR DATOS DE LA MATRICULA QUE VA PAGAR
        return view('pago.realize', compact('matricula', $matricula));
    }

    public function pagoEstudiante(Matricula $matricula)
    {
        $pagos = $matricula->pagos;
        return view('pago.index', compact('pagos', $pagos))->with('status', 'Se muestran los pagos del alumno: ' . $matricula->prematricula->nombre);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoRequest $request)
    {
        //
        Pago::create($request->all());
        return redirect()->route('pago.create')->with('info','ok');
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
