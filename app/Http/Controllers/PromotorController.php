<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotorRequest;
use App\Http\Requests\UpdatePromotorRequest;
use App\Models\Promotor;
use App\Models\User;
use App\Http\Controllers\Generate;
use App\Mail\CredencialesPromotor;
use App\Models\Matricula;
use Illuminate\Support\Facades\Mail;

class PromotorController extends Controller
{
    //Ver todos los promotores
    public function index()
    {
        $promotors = Promotor::getPromotores();
        return view('promotor.index', compact('promotors'));
    }

    //Guardar nuevo promotor
    public function store(StorePromotorRequest $request)
    {
        //Generar credenciales
        $id = Generate::id('PM', 4);
        $pin = Generate::pin();

        //Agregar credenciales en claro
        $request->merge(['carnet' =>  $id]);

        //Guardar
        $promotor = Promotor::create($request->all());
        User::createUser($request->nombre, $id, 'FFFFFF', 'promotor');

        //Enviar correo
        //Mail::to($request->correo)->send(new CredencialesPromotor($promotor, $pin));

        return back()->with('info', config('app.add'));
    }

    //Ver matriculas de un promotor
    public function show($promotor_id)
    {
        $matriculas = Matricula::toPromotorShow($promotor_id);
        return view('promotor.show', compact('matriculas'));
    }

    //Editar promotor
    public function edit($promotor_id)
    {
        $promotor = Promotor::find($promotor_id);
        return view('promotor.edit', compact('promotor'));
    }

    //Actualizar promotor
    public function update(UpdatePromotorRequest $request, $promotor_id)
    {
        User::updateUser(new Promotor(), $promotor_id, $request);
        return redirect()->route('promotores.index')->with('info', config('app.update'));
    }

    //Eliminar promotor
    public function destroy(Promotor $promotor)
    {
        User::where('email', $promotor->carnet)->first()->delete();
        $promotor->delete();
        return redirect()->route('promotores.index')->with('deleted', config('app.deleted'));
    }
}
