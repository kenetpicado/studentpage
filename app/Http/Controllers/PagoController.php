<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Http\Requests\PagoRequest;

class PagoController extends Controller
{
    //Cargar vista de los pagos
    public function index(Inscripcion $inscripcion)
    {
        $inscripcion->load('pagos');
        return view('pago.index', compact('inscripcion'));
    }

    //Guardar pago
    public function store(PagoRequest $request)
    {
        $request->merge(['created_at' => now()]);
        Pago::create($request->all());
        return back()->with('success', 'Guardado');
    }

    //Editar un pago
    public function edit($pago_id)
    {
        $pago = Pago::forEdit($pago_id);
        return view('pago.edit', compact('pago'));
    }

    //Actualizar un pago
    public function update(PagoRequest $request, Pago $pago)
    {
        $pago->update($request->all());
        return redirect()->route('pagos.index', $pago->inscripcion_id)->with('success', 'Actualizado');
    }

    //Eliminar un pago
    public function destroy(Request $request, Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index', $request->inscripcion)->with('success', 'Eliminado');
    }
}
