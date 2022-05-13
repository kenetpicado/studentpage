<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GrupoMatriculaResource;
use App\Models\GrupoMatricula;
use Illuminate\Http\Request;

class GrupoMatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return GrupoMatriculaResource::collection(GrupoMatricula::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GrupoMatricula  $grupoMatricula
     * @return \Illuminate\Http\Response
     */
    public function show(GrupoMatricula $grupoMatricula)
    {
        //
        return new GrupoMatriculaResource($grupoMatricula);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GrupoMatricula  $grupoMatricula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrupoMatricula $grupoMatricula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrupoMatricula  $grupoMatricula
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrupoMatricula $grupoMatricula)
    {
        //
    }
}
