<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Models\Docente;

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
        return view('docente.create', compact('docentes', $docentes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocenteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocenteRequest $request)
    {
        //
        Docente::create([
            'nombre' => $request->nombre,
            'carnet' => Generate::id('CH'),
            'pin' => Generate::pin()
        ]);
        return redirect()->route('docente.create')->with('info', 'El nuevo docente ha sido agregado!');
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
        return view('docente.destroy', compact('docente', $docente));
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
        //
        $docente->update($request->all());
        return redirect()->route('docente.create')->with('info', 'Se ha actualizado el docente!');
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
        return redirect()->route('docente.create')->with('info', 'Se ha eliminado el docente!');
    }
}
