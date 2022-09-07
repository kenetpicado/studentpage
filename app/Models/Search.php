<?php

namespace App\Models;

use App\Traits\rolesTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Search extends Model
{
    use HasFactory;
    use rolesTraits;

    public function matriculas($request)
    {
        return DB::table('grupos')
            ->where('grupos.activo', "1")
            ->when(auth()->user()->rol == 'docente', function ($q) {
                $q->where('grupos.docente_id', auth()->user()->sub_id);
            })
            ->when(auth()->user()->sucursal != 'all' && auth()->user()->rol == 'admin', function ($q) {
                $q->where('grupos.sucursal', auth()->user()->sucursal);
            })
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->join('docentes', 'grupos.docente_id', '=', 'docentes.id')
            ->orWhere('curso_nombre', 'LIKE', '%' . $request->search . '%')
            ->orWhere('docente_nombre', 'LIKE', '%' . $request->search . '%')
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
    }
}
