<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreMensajeRequest;

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
        Mensaje::create($request->all());

        if ($request->has('global'))
            return redirect()->route('mensajes.grupos')->with('success', config('app.created'));

        return back()->with('success', config('app.created'));
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
        $mensaje->update($request->all());

        if ($request->has('global'))
            return redirect()->route('mensajes.grupos')->with('success', config('app.updated'));

        return redirect()->route('mensajes.index', $request->grupo_id)->with('success', config('app.updated'));
    }

    //Eliminar un mensaje
    public function destroy(Request $request, Mensaje $mensaje)
    {
        Gate::authorize('docente_autorizado', $mensaje->grupo_id);
        $mensaje->delete();

        if ($request->has('global'))
            return redirect()->route('mensajes.grupos')->with('success', config('app.deleted'));

        return redirect()->route('mensajes.index', $mensaje->grupo_id)->with('success', config('app.deleted'));
    }

    //Ver mensajes globales
    public function grupos()
    {
        $mensajes = DB::table('mensajes')->where('grupo_id', null)->latest('id')->get();
        return view('mensaje.grupos', compact('mensajes'));
    }

    //Vista de mensajes globales
    public function agregar()
    {
        return view('mensaje.agregar');
    }

    public function modificar($mensaje_id)
    {
        $mensaje = Mensaje::find($mensaje_id);
        return view('mensaje.modificar', compact('mensaje'));
    }
}
