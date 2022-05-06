<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotorRequest;
use App\Http\Requests\UpdatePromotorRequest;
use App\Models\Promotor;
use App\Models\User;
use App\Http\Controllers\Generate;
use App\Mail\CredencialesPromotor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PromotorController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $promotors = Promotor::withCount('matriculas')->get();
        return view('promotor.index', compact('promotors'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromotorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotorRequest $request)
    {
        //Generar credenciales
        $id = Generate::id('PM-', 4);
        $pin = Generate::pin();

        //Agregar credenciales en claro
        $request->merge([
            'carnet' =>  $id
        ]);

        //Guardar en tabla prormotors
        $promotor = Promotor::create($request->all());

        //Guardar cuenta de usuario
        User::create([
            'name' => $request->nombre,
            'email' => $id,
            'password' => Hash::make('FFFFFF'),
            'rol' => 'promotor',
        ]);

        //Enviar correo
        //Mail::to($request->correo)->send(new CredencialesPromotor($promotor, $pin));

        return redirect()->route('promotores.index')->with('info', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotor  $promotor
     * @return \Illuminate\Http\Response
     */
    public function show(Promotor $promotor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotor  $promotor
     * @return \Illuminate\Http\Response
     */
    public function edit($promotor_id)
    {
        //
        $promotor = Promotor::withCount('matriculas')->find($promotor_id);
        return view('promotor.edit', compact('promotor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromotorRequest  $request
     * @param  \App\Models\Promotor  $promotor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromotorRequest $request, Promotor $promotor)
    {
        if ($request->nombre != $promotor->nombre || $request->correo != $promotor->correo) {
            //Obtener usuario
            $user = User::where('email', $promotor->carnet)->first(['id', 'name']);

            //Actualizar en tabla PROMOTOR
            $promotor->update($request->all(['nombre', 'correo']));

            //Actualizar en tabla User
            $user->update(['name' => $request->nombre]);
        }

        return redirect()->route('promotores.index')->with('info', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotor  $promotor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotor $promotor)
    {
        //Elimino de la tabla Users
        User::where('email', $promotor->carnet)->first()->delete();

        //Elimino de la tabla promotor
        $promotor->delete();
        return redirect()->route('promotores.index')->with('info', 'eliminado');
    }
}
