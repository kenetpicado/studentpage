@extends('consulta.layout')

@section('title', 'Consulta')

@section('content')
    <h1 class="h4 text-gray-900 mb-4">Cursos</h1>
    <div class="row">
        @foreach ($inscripciones as $inscripcion)
            <div class="col-xl-6 col-md-6 mb-2">
                <div class="card">
                    <div class="text-center">
                        <img class="" src="{{ asset('courses/' . $inscripcion->curso_imagen) }}" style="height: 250px; width: 250px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $inscripcion->curso_nombre }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $inscripcion->docente_nombre }}</h6>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-primary" href="{{route('consulta.mensajes', $inscripcion->grupo_id)}}">Mensajes</a>
                        <div class="dropdown float-right">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Más
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('consulta.notas', $inscripcion->id)}}">Notas</a>
                                <a class="dropdown-item" href="{{route('consulta.pagos', $inscripcion->id)}}">Pagos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
