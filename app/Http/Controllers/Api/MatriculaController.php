<?php

namespace App\Http\Controllers\Api;

use App\Models\Matricula;
use Illuminate\Http\Request;
use App\Services\Credenciales;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MatriculaController extends Controller
{

    public function index()
    {
        if ($this->isPromotor())
            return response()->json(Matricula::index(), 200);

        return $this->noPromotor();
    }

    public function store(Request $request)
    {
        $request->merge([
            'carnet' => (new Credenciales)->idEstudiante($request->sucursal, $request->fecha_nac),
            'pin' => (new Credenciales)->pin(),
            'promotor_id' => auth()->user()->sub_id,
            'created_at' => now()->format('Y-m-d'),
        ]);

        $validator = Validator::make($request->all(), [
            'carnet' => 'unique:matriculas',
            'nombre' => 'required|max:45',
            'fecha_nac' => 'required|date',
            'grado' => 'required|max:45',
            'sucursal' => 'required|in:CH,MG',
            'cedula' => 'nullable|alpha_dash|min:16|max:16',
            'celular' => 'nullable|numeric|digits:8',
            'tutor' => 'nullable|max:45',
        ]);

        if ($validator->fails())
            return $this->fail($validator);

        Matricula::create($request->all());
        return $this->success();
    }

    public function show(Matricula $matricula)
    {
        if ($this->isAutorizado($matricula))
            return response()->json($matricula, 200);

        return $this->noAutorizado();
    }

    public function update(Request $request, Matricula $matricula)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:45',
            'fecha_nac' => 'required|date',
            'grado' => 'required|max:45',
            'cedula' => 'nullable|alpha_dash|min:16|max:16',
            'celular' => 'nullable|numeric|digits:8',
            'tutor' => 'nullable|max:45',
        ]);

        if ($validator->fails())
            return $this->fail($validator);

        $matricula->update($request->all());
        return $this->success();
    }

    public function success()
    {
        return response()->json([
            'status' => '1',
            'message' => 'success',
        ], 200);
    }

    public function fail($validator)
    {
        return response()->json([
            'status' => '2',
            'message' => $validator->errors()->first(),
        ], 422);
    }

    public function isPromotor()
    {
        return auth()->user()->rol == 'promotor';
    }

    public function noPromotor()
    {
        return response()->json([
            'status' => '0',
            'message' => 'No es promotor',
        ], 403);
    }

    public function isAutorizado($matricula)
    {
        return $matricula->promotor_id == auth()->user()->sub_id;
    }

    public function noAutorizado()
    {
        return response()->json([
            'status' => '0',
            'message' => 'No es propietario de esta matricula'
        ], 403);
    }
}
