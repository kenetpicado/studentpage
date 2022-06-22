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

        //Guardar cuenta de usuario
        User::create([
            'name' => $request->nombre,
            'email' => $id,
            'password' => bcrypt('FFFFFF'),
            'rol' => 'promotor',
            'sub_id' => $promotor->id,
        ]);

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
    public function edit(Promotor $promotor)
    {
        return view('promotor.edit', compact('promotor'));
    }

    //Actualizar promotor
    public function update(UpdatePromotorRequest $request, Promotor $promotor)
    {
        $promotor->update($request->all());
        User::updateUser($promotor);
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
