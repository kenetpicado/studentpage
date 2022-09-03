<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Services\Moneda;
use App\Models\Inscripcion;
use App\Http\Requests\PagoRequest;
use App\Models\Matricula;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    //Cargar vista de los pagos
    public function index($matricula_id)
    {
        $matricula = Matricula::nombre($matricula_id);
        $pagos = Pago::index($matricula_id);
        return view('pago.index', compact('pagos', 'matricula'));
    }

    //Crear nuevo pago
    public function create($matricula_id)
    {
        $matricula = Matricula::nombre($matricula_id);
        $grupos = Inscripcion::grupos($matricula_id);
        $monedas = (new Moneda)->get();
        return view('pago.create', compact('matricula_id', 'monedas', 'grupos', 'matricula'));
    }

    //Guardar pago
    public function store(PagoRequest $request)
    {
        Pago::create($request->all());
        return redirect()->route('pagos.index', $request->matricula_id)->with('success', config('app.created'));
    }

    //Editar un pago
    public function edit(Pago $pago)
    {
        $monedas = (new Moneda)->get();
        $grupos = Inscripcion::grupos($pago->matricula_id);
        $matricula = Matricula::nombre($pago->matricula_id);
        return view('pago.edit', compact('pago', 'monedas', 'grupos', 'matricula'));
    }

    //Actualizar un pago
    public function update(PagoRequest $request, Pago $pago)
    {
        $pago->update($request->all());
        return redirect()->route('pagos.index', $pago->matricula_id)->with('success', config('app.updated'));
    }

    //Eliminar un pago
    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index', $pago->matricula_id)->with('success', config('app.deleted'));
    }

    //Ver recibo
    public function recibo($pago_id)
    {
        $pago = Pago::recibo($pago_id);
        return view('pago.recibo', compact('pago'));
    }
}
