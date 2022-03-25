<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotorRequest;
use App\Http\Requests\UpdatePromotorRequest;
use App\Models\Promotor;
use App\Http\Controllers\Generate;

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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $promotors = Promotor::all();
        return view('promotor.create', compact('promotors', $promotors));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromotorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotorRequest $request)
    {
        //Guardar promotor
        Promotor::create([
            'nombre' => $request->nombre,
            'carnet' => Generate::id('CH'),
            'pin' => Generate::pin()
        ]);
        
        return redirect()->route('promotor.create')->with('info', 'El promotor ha sido guardado!');
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
        return view('promotor.destroy', compact('promotor', $promotor));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotor  $promotor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotor $promotor)
    {
        //
        $promotor->delete();
        return redirect()->route('promotor.create')->with('info', 'Se ha eliminado el promotor!');
    }
}
