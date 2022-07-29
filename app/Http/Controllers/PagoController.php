<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Services\Moneda;
use App\Http\Requests\PagoRequest;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    //Cargar vista de los pagos
    public function index($matricula_id)
    {
        $pagos = Pago::where('matricula_id', $matricula_id)->get();
        return view('pago.index', compact('pagos', 'matricula_id'));
    }

    //Crear nuevo pago
    public function create($matricula_id)
    {
        $monedas = (new Moneda)->get();
        return view('pago.create', compact('matricula_id', 'monedas'));
    }

    //Guardar pago
    public function store(PagoRequest $request)
    {
        $request->merge(['created_at' => now()]);
        Pago::create($request->all());
        return redirect()->route('pagos.index', $request->matricula_id)->with('success', 'Pago guardado correctamente');
    }

    //Editar un pago
    public function edit($pago_id)
    {
        $monedas = (new Moneda)->get();
        $pago = DB::table('pagos')->find($pago_id);
        return view('pago.edit', compact('pago', 'monedas'));
    }

    //Actualizar un pago
    public function update(PagoRequest $request, Pago $pago)
    {
        $pago->update($request->all());
        return redirect()->route('pagos.index', $pago->matricula_id)->with('success', 'Pago actualizado correctamente');
    }

    //Eliminar un pago
    public function destroy(Pago $pago)
    {
        $matricula_id = $pago->matricula_id;
        $pago->delete();
        return redirect()->route('pagos.index', $matricula_id)->with('success', 'Pago eliminado correctamente');
    }
}
