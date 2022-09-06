<?php

namespace App\Http\Controllers;

use App\Traits\rolesTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    use rolesTraits;

    public function matriculas(Request $request)
    {
        $matriculas = DB::table('matriculas')
            ->when(SearchController::esPromotor(), function ($q) {
                $q->where('promotor_id', auth()->user()->sub_id);
            })
            ->when(SearchController::adminSucursal(), function ($q) {
                $q->where('sucursal', auth()->user()->sucursal);
            })
            ->where(function ($query) use ($request) {
                $query->where('nombre', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('carnet', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('created_at', 'LIKE', '%' . $request->search . '%');
            })
            ->latest('id')
            ->select([
                'id',
                'carnet',
                'nombre',
                'created_at',
                'activo',
                DB::raw('(select count(*) from inscripciones where matriculas.id = inscripciones.matricula_id) as inscripciones_count')
            ])
            ->paginate(20);

        return view('matricula.index', compact('matriculas'));
    }

    public function grupos(Request $request)
    {
        $grupos = DB::table('grupos')
            ->where('grupos.activo', "1")
            ->when(SearchController::esDocente(), function ($q) {
                $q->where('grupos.docente_id', auth()->user()->sub_id);
            })
            ->when(SearchController::adminSucursal(), function ($q) {
                $q->where('grupos.sucursal', auth()->user()->sucursal);
            })
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->where(function ($query) use ($request) {
                $query->where('cursos.nombre', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('horario', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('anyo', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('docentes.nombre', 'LIKE', '%' . $request->search . '%');
            })
            ->latest('grupos.id')
            ->orderBy('sucursal')
            ->select([
                'grupos.id',
                'horario',
                'anyo',
                'grupos.sucursal',
                'cursos.nombre as curso_nombre',
                'docentes.nombre as docente_nombre',
            ])
            ->paginate(20);

        return view('grupo.index', compact('grupos'));
    }
}
