<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMensajeRequest;
use App\Models\Matricula;
use App\Models\Mensaje;
use Illuminate\Support\Facades\Gate;

class MensajeController extends Controller
{
    //Ver todos los mensajes de un grupo
    public function index($grupo_id)
    {
        Gate::authorize('docente_autorizado', $grupo_id);
        $mensajes = Mensaje::getByGrupo($grupo_id);
        return view('mensaje.index', compact('mensajes', 'grupo_id'));
    }

    //Guardar mensaje
    public function store(StoreMensajeRequest $request)
    {
        Gate::authorize('docente_autorizado', $request->grupo_id);
        $request->merge([
            'from' => auth()->user()->name,
            'created_at' => now(),
        ]);

        Mensaje::create($request->all());
        return back()->with('success', 'Guardado');
    }

    //Editar un mensaje
    public function edit(Mensaje $mensaje)
    {
        Gate::authorize('docente_autorizado', $mensaje->grupo_id);
        return view('mensaje.edit', compact('mensaje'));
    }

    //Actualizar un mensaje
    public function update(StoreMensajeRequest $request, Mensaje $mensaje)
    {
        Gate::authorize('docente_autorizado', $mensaje->grupo_id);
        $request->merge([
            'from' => auth()->user()->name,
            'created_at' => now(),
        ]);

        $mensaje->update($request->all());
        return redirect()->route('mensajes.index', $request->grupo_id)->with('success', 'Actualizado');
    }

    //Eliminar un mensaje
    public function destroy(Mensaje $mensaje)
    {
        Gate::authorize('docente_autorizado', $mensaje->grupo_id);
        $grupo_id = $mensaje->grupo_id;
        $mensaje->delete();
        return redirect()->route('mensajes.index', $grupo_id)->with('success', 'Eliminado');
    }
}
