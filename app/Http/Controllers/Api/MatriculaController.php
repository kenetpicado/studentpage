<?php

namespace App\Http\Controllers\Api;

use App\Models\Matricula;
use Illuminate\Http\Request;
use App\Services\Credenciales;
use App\Http\Controllers\Controller;
use App\Traits\ApiTraits;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class MatriculaController extends Controller
{
    use ApiTraits;

    public function index()
    {
        if (Gate::denies('is_promotor'))
            return $this->unauthorized();

        return response()->json(Matricula::index(), 200);
    }

    public function store(Request $request)
    {
        if (Gate::denies('create_matricula'))
            return $this->unauthorized();

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
        if (Gate::denies('propietario-matricula', $matricula))
            return $this->unauthorized();

        return response()->json($matricula, 200);
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

    public function fail($validator)
    {
        return response()->json([
            'status' => '2',
            'message' => $validator->errors()->first(),
        ], 422);
    }
}
