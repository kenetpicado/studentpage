@extends('consulta.layout')

@section('title', 'Consulta')

@section('content')

    <div class="container">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Datos</h1>
        </div>

        <p>Nombre: <strong>{{ $matricula->nombre }}</strong></p>
        <p>Carnet: <strong>{{ $matricula->carnet }}</strong></p>
        <p>Fecha de nacimiento: <strong>{{ $matricula->fecha_nac }}</strong></p>
        <hr>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cursos</h1>
        </div>

        <div class="row">
            @foreach ($inscripcion as $gm)
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ $gm->grupo->docente->nombre }}</div>
                                    <div class="h5 mb-2 font-weight-bold text-gray-800 text-uppercase">
                                        {{ $gm->grupo->curso->nombre }}
                                    </div>
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                        {{ $gm->grupo->horario }} - {{ $gm->grupo->anyo }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('consulta.show', $gm->id) }}">
                                        <i class="fas fa-angle-double-right fa-2x"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection('content')
