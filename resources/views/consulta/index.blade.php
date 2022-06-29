@extends('consulta.layout')

@section('title', 'Consulta')

@section('content')
    <h1 class="h4 text-gray-900 mb-4 text-uppercase">Cursos</h1>

    <div class="row">
        @foreach ($inscripciones as $inscripcion)
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary mb-1">
                                    {{ $inscripcion->docente_nombre }}</div>

                                <div class="h5 mb-2 font-weight-bold text-gray-800 text-uppercase">
                                    {{ $inscripcion->curso_nombre }}
                                </div>
                                <div class="text-xs font-weight-bold text-secondary mb-1">
                                    {{ $inscripcion->grupo_horario }} - {{ $inscripcion->grupo_anyo }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('consulta.show', $inscripcion->id) }}">
                                    <i class="fas fa-angle-double-right fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
