<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Mail\CredencialesDocente;
use App\Models\Docente;
use App\Models\User;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;

class DocenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin');

        $sucursal = Auth::user()->sucursal;

        if ($sucursal == 'all') {
            $docentes = Docente::all(['id', 'carnet', 'nombre', 'correo', 'estado']);
        } else {
            $docentes = Docente::where('sucursal', $sucursal)->get(['id', 'carnet', 'nombre', 'correo', 'estado']);
        }

        return view('docente.index', compact('docentes'));
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
     * @param  \App\Http\Requests\StoreDocenteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocenteRequest $request)
    {
        Gate::authorize('admin');

        //Si es admin de sucursal especifica
        $sucursal = $request->user()->sucursal;

        if ($sucursal != 'all') {
            $request->merge([
                'sucursal' =>  $sucursal,
            ]);
        }

        //Generar credenciales
        $id = Generate::id($request->sucursal . '-', 4);
        $pin = Generate::pin();

        //Agregar credenciales en claro
        $request->merge([
            'carnet' =>  $id,
        ]);

        //Guardar en la base de datos
        $docente = Docente::create($request->all());

        //Guardar cuenta de usuario
        User::create([
            'name' => $request->nombre,
            'email' => $id,
            'password' => Hash::make('FFFFFF'),
            'rol' => 'docente',
            'sucursal' => $request->sucursal
        ]);

        //Enviar correo
        //Mail::to($request->correo)->send(new CredencialesDocente($docente, $pin));

        return redirect()->route('docentes.index')->with('info', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show($docente_id)
    {
        $docente = Docente::find($docente_id, ['id', 'nombre']);

        $grupos = Grupo::where('docente_id', $docente_id)
            ->with(['curso:id,nombre'])
            ->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);

        return view('docente.show', compact('grupos', 'docente'));
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
        Gate::authorize('admin');
        return view('docente.edit', compact('docente'));
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
        Gate::authorize('admin');

        //Obtener usuario de la tabla user
        $user = User::where('email', $docente->carnet)->first(['id', 'name']);

        //Actualizar en tabla docente
        $docente->update($request->all());

        //Actualizar en tabla User
        $user->update(['name' => $request->nombre]);

        return redirect()->route('docentes.index')->with('info', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        Gate::authorize('admin');

        //Elimino de la tabla Users
        User::where('email', $docente->carnet)->first()->delete();

        //Elimino de la tabla promotor
        $docente->delete();
        return redirect()->route('docentes.index')->with('info', 'eliminado');
    }
}
