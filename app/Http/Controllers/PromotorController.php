<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotorRequest;
use App\Http\Requests\UpdatePromotorRequest;
use App\Models\Promotor;
use App\Models\User;
use App\Http\Controllers\Generate;
use App\Mail\CredencialesPromotor;
use App\Mail\Restablecimiento;
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
        $promotors = Promotor::all();
        return view('promotor.index', compact('promotors', $promotors));
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
            'carnet' =>  $id,
            'pin' => $pin
        ]);

        //Guardar instancia para enviar
        $promotor = new Promotor($request->all());

        //Guardar en tabla prormotors
        Promotor::create($request->except('pin'));

        //Guardar cuenta de usuario
        User::create([
            'name' => $request->nombre,
            'email' => $id,
            'password' => Hash::make('FFFFFF'),
            'rol' => 'promotor',
        ]);

        //Enviar correo
        //Mail::to($request->correo)->send(new CredencialesPromotor($promotor));

        return redirect()->route('promotor.index')->with('info', 'ok');
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
        //Obtener usuario
        $user = User::where('email', '=', $promotor->carnet)->first();

        //si hay flag de pin restablecemos
        if ($request->has('pin')) {
            $pin =  Generate::pin();
            $user->update(['password' => Hash::make('FFFFFF')]);

            //Enviar correo con nuevo pin
            //Mail::to($promotor->correo)->send(new Restablecimiento($promotor->carnet, $pin));
        } else {
            //Correo unico ignorando el propio
            $request->validate([
                'correo' => ['required', Rule::unique('promotors')->ignore($promotor->id)],
                'nombre' => 'required',
            ]);

            //Actualizar en tabla docente
            $promotor->update($request->all());

            //Actualizar en tabla User
            $user->update(['name' => $request->nombre]);
        }

        return redirect()->route('promotor.index')->with('info', 'ok');
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
        User::where('email', '=', $promotor->carnet)->first()->delete();
        
        //Elimino de la tabla promotor
        $promotor->delete();
        return redirect()->route('promotor.index')->with('info', 'eliminado');
    }
}
