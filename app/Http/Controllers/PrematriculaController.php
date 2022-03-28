<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrematriculaRequest;
use App\Http\Requests\UpdatePrematriculaRequest;
use App\Models\Prematricula;

class PrematriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $prematriculas = Prematricula::all();
        return view('prematricula.index', compact('prematriculas', $prematriculas))->with('status', 'todas');
    }

    public function active()
    {
        $prematriculas = Prematricula::has('matricula')->get();
        return view('prematricula.index', compact('prematriculas', $prematriculas))->with('status', 'activas');
    }

    public function inactive()
    {
        $prematriculas = Prematricula::has('matricula', '=', '0')->get();
        return view('prematricula.index', compact('prematriculas', $prematriculas))->with('status', 'inactivas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('prematricula.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrematriculaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrematriculaRequest $request)
    {
        //
        Prematricula::create($request->all());
        return redirect()->route('prematricula.create')->with('info', 'Los datos han sido guardados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prematricula  $prematricula
     * @return \Illuminate\Http\Response
     */
    public function show(Prematricula $prematricula)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prematricula  $prematricula
     * @return \Illuminate\Http\Response
     */
    public function edit(Prematricula $prematricula)
    {
        //
        return view('prematricula.edit', compact('prematricula', $prematricula));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrematriculaRequest  $request
     * @param  \App\Models\Prematricula  $prematricula
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrematriculaRequest $request, Prematricula $prematricula)
    {
        //
        $prematricula->update($request->all());
        return redirect()->route('prematricula.index')->with('info', 'Se actualizaron los datos!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prematricula  $prematricula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prematricula $prematricula)
    {
        //
    }
}
