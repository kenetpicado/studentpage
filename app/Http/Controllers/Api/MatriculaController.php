<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use App\Models\User;
use App\Models\Promotor;
use App\Http\Resources\matricula\MatriculaIndex;
use Illuminate\Http\Request;
use App\Http\Controllers\Generate;
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
        $promotor = User::loggedId();

        if ($promotor == 'admin') {
            return response()->json([
                'status' => '0',
                'message' => 'No es promotor',
            ], 401);
        } else {

            $matricula = Matricula::where('promotor_id', $promotor)
                ->get(['id', 'nombre', 'carnet']);

            return response()->json($matricula, 200);
        }
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
            'tel' => 'telefono',
        ]);

        if ($validator->fails())
            return $validator->errors();

        $carnet = Generate::idEstudiante($request->sucursal, $request->fecha_nac);
        $pin = Generate::pin();

        //Agregar campos que faltan
        $request->merge([
            'carnet' =>  $carnet,
            'pin' => $pin,
            'promotor_id' => auth()->user()->sub_id,
            'created_at' => now()->format('Y-m-d'),
        ]);

        $request->validate([
            'carnet' => 'unique:matriculas'
        ]);

        //Guardar datos
        $matricula = Matricula::create($request->all());

        //Crear cuenta de usuario
        User::create([
            'name' => $request->nombre,
            'email' => $carnet,
            'password' => bcrypt('FFFFFF'),
            'rol' => 'alumno',
            'sucursal' => $request->sucursal,
            'sub_id' => $matricula->id,
        ]);

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
        if ($matricula->delete()) {
            return response()->json(['message' => 'Matricula eliminada correctamente'], 200);
        }
        return response()->json(['message' => 'Error al eliminar la matricula'], 500);
    }
}
