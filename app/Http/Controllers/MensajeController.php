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
    public function index($type, $grupo_id = null)
    {
        Gate::authorize('docente_autorizado', $grupo_id);

        $mensajes = $grupo_id == null
            ? DB::table('mensajes')->where('grupo_id', null)->latest('id')->paginate(10)
            : Mensaje::getByGrupo($grupo_id);

        return view('mensaje.index', compact('mensajes', 'grupo_id', 'type'));
    }

    //Guardar mensaje
    public function store(StoreMensajeRequest $request)
    {  
        if (Gate::denies('create_mensaje'))
            return back()->with('error', config('app.denies'));

        Gate::authorize('docente_autorizado', $request->grupo_id);
        Mensaje::create($request->all());

        if ($request->type == 'global')
            return redirect()->route('mensajes.index', 'global')->with('success', config('app.created'));

        return redirect()->route('mensajes.index', ['grupo', $request->grupo_id])->with('success', config('app.created'));
    }

    //Editar un mensaje
    public function edit($type, $mensaje_id)
    {
        $mensaje = Mensaje::find($mensaje_id);
        Gate::authorize('docente_autorizado', $mensaje->grupo_id);
        return view('mensaje.edit', compact('mensaje', 'type'));
    }

    //Actualizar un mensaje
    public function update(StoreMensajeRequest $request, Mensaje $mensaje)
    {
        Gate::authorize('docente_autorizado', $mensaje->grupo_id);
        $mensaje->update($request->all());

        if ($request->type == 'global')
            return redirect()->route('mensajes.index', 'global')->with('success', config('app.updated'));

        return redirect()->route('mensajes.index', ['grupo', $request->grupo_id])->with('success', config('app.updated'));
    }

    //Eliminar un mensaje
    public function destroy(Request $request, Mensaje $mensaje)
    {
        Gate::authorize('docente_autorizado', $mensaje->grupo_id);
        $mensaje->delete();

        if ($request->type == 'global')
            return redirect()->route('mensajes.index', 'global')->with('success', config('app.deleted'));

        return redirect()->route('mensajes.index', ['grupo', $request->grupo_id])->with('success', config('app.deleted'));
    }
}
