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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        switch ($user->rol) {
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
            $matriculas = new Matricula();
            $docentes = new Docente();
            $grupos = new Grupo();

                $info = ([
                    'docentes' =>  $this->countActive($docentes, $user->sucursal),

                    'cursos' => Curso::where('activo', '1')->count(),
                    'promotores' => Promotor::all()->count(),

                    'grupos_anyo' => $this->currentActive($grupos, $user->sucursal),
                    'grupos_all' => $grupos->count(),

                    'matriculas_anyo' => $this->currentActive($matriculas, $user->sucursal),
                    'matriculas_all' => $matriculas->count(),
                ]);

                return view('index', compact('info'));
                break;
        }
    }

    public static function countActive($model, $sucursal)
    {
        switch ($sucursal) {
            case 'all':
                return $model->where('activo', '1')->count();
                break;
            default:
                return $model->where('sucursal', $sucursal)
                    ->where('activo', '1')
                    ->count();
                break;
        }
    }

    public static function currentActive($model, $sucursal)
    {
        switch ($sucursal) {
            case 'all':
                return $model->where('anyo', date('Y'))
                    ->where('activo', '1')
                    ->count();
                break;
            default:
                return $model->where('sucursal', $sucursal)
                    ->where('anyo', date('Y'))
                    ->where('activo', '1')
                    ->count();
                break;
        }
    }
}
