<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PromotorResource;
use App\Models\Promotor;
use Illuminate\Http\Request;

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
        return PromotorResource::collection(Promotor::latest()->paginate());
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
     * @param  \App\Models\Promotor  $promotor
     * @return \Illuminate\Http\Response
     */
    public function show(Promotor $promotor)
    {
        //
        return new PromotorResource($promotor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotor  $promotor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotor $promotor)
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
    }
}
