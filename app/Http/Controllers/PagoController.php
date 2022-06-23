<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Models\Inscripcion;
use App\Models\Pago;
use Illuminate\Http\Request;

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
        $request->merge(['created_at' => now()->format('Y-m-d')]);
        Pago::create($request->all());
        return back()->with('success', 'Guardado');
    }

    public function edit(Pago $pago)
    {
        $pago->load('inscripcion');
        return view('pago.edit', compact('pago'));
    }

    public function update(StorePagoRequest $request, Pago $pago)
    {
        $pago->update($request->all());
        return redirect()->route('pagos.index', $pago->inscripcion_id)->with('success', 'Actualizado');
    }

    public function destroy(Request $request, Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index', $request->inscripcion)->with('success', 'Eliminado');
    }
}
