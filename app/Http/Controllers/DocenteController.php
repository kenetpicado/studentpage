<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Mail\CredencialesDocente;
use App\Models\Docente;
use App\Models\User;
use App\Models\Grupo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;

class DocenteController extends Controller
{
    //Mostrar docentes segun sucursal
    public function index()
    {
        $docentes = auth()->user()->sucursal == 'all'
            ? Docente::getDocentes()
            : Docente::getDocentesSucursal(auth()->user()->sucursal);

        return view('docente.index', compact('docentes'));
    }

    //Guardar docente
    public function store(StoreDocenteRequest $request)
    {
        if (auth()->user()->sucursal != 'all')
            $request->merge(['sucursal' => auth()->user()->sucursal]);

        //Generar credenciales
        $id = Generate::id($request->sucursal, 4);
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

        return back()->with('info', config('app.add'));
    }

    //Ver grupos de un docente
    public function show($docente_id)
    {
        $grupos = Grupo::getGruposDocente($docente_id, '1');
        return view('docente.show', compact('grupos'));
    }

    //Formulario para editar un docente
    public function edit(Docente $docente)
    {
        return view('docente.edit', compact('docente'));
    }

    //Actualizar un docente
    public function update(UpdateDocenteRequest $request, $docente_id)
    {
        if ($request->activo == null)
            $request->merge(['activo' => '0']);

        User::updateUser(new Docente(), $docente_id, $request);
        return redirect()->route('docentes.index')->with('info', config('app.update'));
    }

    //Eliminar un docente
    public function destroy($docente_id)
    {
        User::deleteUser(new Docente(), $docente_id);
        return redirect()->route('docentes.index')->with('deleted', config('app.deleted'));
    }
}
