<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Mail\CredencialesDocente;
use App\Models\Docente;
use App\Models\User;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;

class DocenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Mostrar docentes segun sucursal
    public function index()
    {
        Gate::authorize('admin');
        $sucursal = Auth::user()->sucursal;

        $docentes = $sucursal == 'all' ? 
        Docente::getDocentes() : Docente::getDocentesSucursal($sucursal);

        return view('docente.index', compact('docentes'));
    }

    //Guardar docente
    public function store(StoreDocenteRequest $request)
    {
        Gate::authorize('admin');
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
        User::createUser($request->nombre, $id, 'FFFFFF', 'docente', $request->sucursal);

        //Enviar correo
        //Mail::to($request->correo)->send(new CredencialesDocente($docente, $pin));

        return redirect()->route('docentes.index')->with('info', 'ok');
    }

    //Ver grupos de un docente
    public function show($docente_id)
    {
        Gate::authorize('admin');
        $grupos = Grupo::getGruposDocente($docente_id);
        return view('docente.show', compact('grupos'));
    }

    public function edit(Docente $docente)
    {
        Gate::authorize('admin');
        return view('docente.edit', compact('docente'));
    }

    public function update(UpdateDocenteRequest $request, Docente $docente)
    {
        Gate::authorize('admin');

        $docente->update($request->all());
        User::updateUser($docente->carnet, $request->nombre);

        return redirect()->route('docentes.index')->with('info', 'ok');
    }

    public function destroy(Docente $docente)
    {
        Gate::authorize('admin');

        $docente->delete();
        User::deleteUser($docente->carnet);
        
        return redirect()->route('docentes.index')->with('info', 'eliminado');
    }
}
