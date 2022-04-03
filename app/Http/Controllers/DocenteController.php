<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Mail\CredencialesDocente;
use App\Models\Docente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class DocenteController extends Controller
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
        $docentes = Docente::all();
        return view('docente.create', compact('docentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocenteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocenteRequest $request)
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
        $docente = new Docente($request->all());

        //Encriptar el pin
        $request->merge(['pin' => Hash::make($pin)]);

        //Guardar en la base de datos
        Docente::create($request->all());

        //Enviar correo
        //Mail::to($request->correo)->send(new CredencialesDocente($docente));

        return redirect()->route('docente.create')->with('info', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        //
    }

    public function verGrupos(Docente $docente)
    {
        return view('docente.grupos', compact('docente', $docente))->with('status', 'Todos los grupos asignados al docente: ' . $docente->nombre);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        //
        return view('docente.edit', compact('docente', $docente));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocenteRequest  $request
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocenteRequest $request, Docente $docente)
    {
        //VALIDAR QUE EL CORREO SEA UNICO
        //PERO QUE IGNORE EL PROPIO
        $request->validate(
                ['correo' => [Rule::unique('docentes')->ignore($docente->id)]]
        );

        $docente->update($request->all());
        return redirect()->route('docente.create')->with('info', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        //
        $docente->delete();
        return redirect()->route('docente.create')->with('info', 'eliminado');
    }
}
