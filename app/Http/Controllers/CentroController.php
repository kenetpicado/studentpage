<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCentroRequest;
use App\Http\Requests\UpdateCentroRequest;
use App\Models\Centro;

class CentroController extends Controller
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
        if (Centro::all()->isEmpty()) {
            return view('centro.create');
        } else {
            $centro = Centro::all()->first();
            return view('centro.show', compact('centro', $centro));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCentroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCentroRequest $request)
    {
        //
        Centro::create($request->all());
        return redirect()->route('centro.create')->with('info', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function show(Centro $centro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function edit(Centro $centro)
    {
        //
        return view('centro.edit', compact('centro', $centro));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCentroRequest  $request
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCentroRequest $request, Centro $centro)
    {
        //
        $centro->update($request->all());
        return redirect()->route('centro.create')->with('info', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centro $centro)
    {
        //
    }
}
