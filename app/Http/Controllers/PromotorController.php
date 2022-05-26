<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotorRequest;
use App\Http\Requests\UpdatePromotorRequest;
use App\Models\Promotor;
use App\Models\User;
use App\Http\Controllers\Generate;
use App\Mail\CredencialesPromotor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;

class PromotorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Ver todos los promotores
    public function index()
    {
        Gate::authorize('admin');
        $promotors = Promotor::getPromotores();
        return view('promotor.index', compact('promotors'));
    }

    //Guardar nuevo promotor
    public function store(StorePromotorRequest $request)
    {
        Gate::authorize('admin');

        //Generar credenciales
        $id = Generate::id('PM-', 4);
        $pin = Generate::pin();

        //Agregar credenciales en claro
        $request->merge([
            'carnet' =>  $id
        ]);

        //Guardar
        $promotor = Promotor::create($request->all());
        User::createUser($request->nombre, $id, 'FFFFFF', 'promotor');

        //Enviar correo
        //Mail::to($request->correo)->send(new CredencialesPromotor($promotor, $pin));

        return redirect()->route('promotores.index')->with('info', 'ok');
    }

    //Editar promotor
    public function edit($promotor_id)
    {
        Gate::authorize('admin');
        $promotor = Promotor::getPromotor($promotor_id);
        return view('promotor.edit', compact('promotor'));
    }

    //Actualizar promotor
    public function update(UpdatePromotorRequest $request, $promotor_id)
    {
        Gate::authorize('admin');
        User::updateUser(new Promotor(), $promotor_id, $request);
        return redirect()->route('promotores.index')->with('info', 'ok');
    }

    //Eliminar promotor
    public function destroy($promotor_id)
    {
        Gate::authorize('admin');
        User::deleteUser(new Promotor(), $promotor_id);
        return redirect()->route('promotores.index')->with('info', 'eliminado');
    }
}
