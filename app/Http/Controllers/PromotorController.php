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

    public function index()
    {
        Gate::authorize('admin');
        //
        $promotors = Promotor::withCount('matriculas')->get();
        return view('promotor.index', compact('promotors'));
    }

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

        //Guardar en tabla promotors
        $promotor = Promotor::create($request->all());

        //Guardar cuenta de usuario
        User::createUser($request->nombre, $id, 'FFFFFF', 'promotor');

        //Enviar correo
        //Mail::to($request->correo)->send(new CredencialesPromotor($promotor, $pin));

        return redirect()->route('promotores.index')->with('info', 'ok');
    }

    public function edit($promotor_id)
    {
        Gate::authorize('admin');
        //
        $promotor = Promotor::withCount('matriculas')->find($promotor_id);
        return view('promotor.edit', compact('promotor'));
    }

    public function update(UpdatePromotorRequest $request, Promotor $promotor)
    {
        Gate::authorize('admin');

        if ($request->nombre != $promotor->nombre || $request->correo != $promotor->correo) {

            //Actualizar en tabla PROMOTOR
            $promotor->update($request->all(['nombre', 'correo']));

            //Actualizar en tabla User
            User::updateUser($promotor->carnet, $request->nombre);
        }

        return redirect()->route('promotores.index')->with('info', 'ok');
    }

    public function destroy(Promotor $promotor)
    {
        Gate::authorize('admin');

        //Elimino de la tabla Users
        User::deleteUser($promotor->carnet);

        //Elimino de la tabla promotor
        $promotor->delete();
        return redirect()->route('promotores.index')->with('info', 'eliminado');
    }
}
