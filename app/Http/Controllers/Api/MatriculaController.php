<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use App\Models\User;
use App\Models\Promotor;
use App\Http\Resources\matricula\MatriculaIndex;
use Illuminate\Http\Request;
use App\Http\Controllers\Generate;
use Carbon\Carbon;
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
        $promotor = User::loggedId(new Promotor());

        if ($promotor == 'admin') {
            return response()->json([
                'status' => '0',
                'message' => 'No es promotor',
            ], 401);
        } else {

            $matricula = Matricula::where('promotor_id', $promotor)
                ->get(['id', 'nombre', 'carnet']);

            return response()->json([
                'status' => '1',
                'message' => 'success',
                'matriculas' => $matricula
            ], 200);
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
            'tel' => 'nullable|min:8|max:8',
            'grado' => 'required|max:45',
            'sucursal' => 'required|in:CH,MG'
        ], [], [
            'fecha_nac' => 'fecha de nacimiento',
            'tel' => 'telefono',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        //Obtener usuario
        $user = auth()->user();

        //Obtener promotor
        $id = Promotor::where('carnet', $user->email)->first(['id'])->id;

        $carnet = Generate::idEstudiante($request->sucursal . '04', $request->fecha_nac);
        $pin = Generate::pin();

        //Agregar campos que faltan
        $request->merge([
            'carnet' =>  $carnet,
            'pin' => $pin,
            'promotor_id' => $id,
            'created_at' => Carbon::now()->format('Y-m-d'),
        ]);

        $request->validate([
            'carnet' => 'unique:matriculas'
        ]);

        //Guardar datos
        Matricula::create($request->all());

        User::createUser($request->nombre, $carnet, $pin, 'alumno', $request->sucursal);

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
