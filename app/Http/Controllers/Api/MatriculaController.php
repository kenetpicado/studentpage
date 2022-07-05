<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Services\FormattingRequest;
use Illuminate\Support\Facades\Validator;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (auth()->user()->rol != 'promotor')
            return response()->json([
                'status' => '0',
                'message' => 'No es promotor',
            ], 401);

        $matricula = Matricula::where('promotor_id', auth()->user()->sub_id)->get(['id', 'nombre', 'carnet']);
        return response()->json($matricula, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:45',
            'cedula' => 'nullable|alpha_dash|min:16|max:16',
            'fecha_nac' => 'required|date',
            'celular' => 'nullable|numeric|digits:8',
            'grado' => 'required|max:45',
            'sucursal' => 'required|in:CH,MG'
        ], [], [
            'fecha_nac' => 'fecha de nacimiento',
        ]);

        if ($validator->fails())
            return response()->json([
                'status' => '0',
                'message' => $validator->errors()->first(),
            ], 500);

        $formated = (new FormattingRequest)->alumno($request);
        $matricula = Matricula::create($formated->all());
        (new UserController)->store($formated, $matricula->id);

        return response()->json([
            'status' => '1',
            'message' => 'success',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        //
        if ($matricula->promotor_id != auth()->user()->sub_id)
            return response()->json([
                'status' => '0',
                'message' => 'No es propietario de esta matricula'
            ], 403);

        return response()->json($matricula, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricula $matricula)
    {
        //
        if ($matricula->promotor_id != auth()->user()->sub_id)
            return response()->json([
                'status' => '0',
                'message' => 'No es propietario de esta matricula'
            ], 403);

        return response()->json($matricula, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matricula $matricula)
    {
        if ($matricula->promotor_id != auth()->user()->sub_id)
            return response()->json([
                'status' => '0',
                'message' => 'No es propietario de esta matricula'
            ], 403);

        if ($matricula->delete()) {
            return response()->json(['message' => 'Matricula eliminada correctamente'], 200);
        }

        return response()->json(['message' => 'Error al eliminar la matricula'], 500);
    }
}
