<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotorRequest;
use App\Http\Requests\UpdatePromotorRequest;
use App\Models\Promotor;
use App\Http\Controllers\Generate;
use App\Mail\CredencialesPromotor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $promotors = Promotor::all();
        return view('promotor.create', compact('promotors', $promotors));
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
        $id = Generate::id('CH');
        $pin = Generate::pin();

        //Agregar credenciales en claro
        $request->merge([
            'carnet' =>  $id,
            'pin' => $pin
        ]);

        //Guardar instancia para enviar
        $promotor = new Promotor($request->all());

        //Encriptar el pin
        $request->merge(['pin' => Hash::make($pin)]);

        //Guardar en la base de datos
        Promotor::create($request->all());

        //Enviar correo
        //Mail::to($request->correo)->send(new CredencialesPromotor($promotor));

        return redirect()->route('promotor.create')->with('info', 'ok');
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
    public function edit(Promotor $promotor)
    {
        //
        return view('promotor.edit', compact('promotor', $promotor));
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
        //VALIDAR QUE EL CORREO SEA UNICO
        //PERO QUE IGNORE EL PROPIO
        $request->validate(
            ['correo' => [Rule::unique('promotors')->ignore($promotor->id)]]
        );

        $promotor->update($request->all());
        return redirect()->route('promotor.create')->with('info', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotor  $promotor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotor $promotor)
    {
        //
        $promotor->delete();
        return redirect()->route('promotor.create')->with('info', 'eliminado');
    }
}
