<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Matricula;
use App\Models\Promotor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        switch (auth()->user()->rol) {
            case 'alumno':
                return redirect()->route('consulta.index');
                break;
            case 'docente':
                return redirect()->route('grupos.index');
                break;
            case 'promotor':
                return redirect()->route('matriculas.index');
                break;
            default:
                return view('index');
                break;
        }
    }
}
