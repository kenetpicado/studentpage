@extends('layout')

@section('title', 'Consulta')

@section('content')
    <x-header-0>Cursos</x-header-0>

    <div class="row justify-content-center mb-4">
        <div class="col-lg-4">
            <div class="card-body">

                @foreach ($inscripciones as $inscripcion)
                    <div class="card">
                        <div class="text-center">
                            <img src="{{ asset('courses/' . $inscripcion->curso_imagen) }}"
                                style="height: 250px; width: 250px;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $inscripcion->curso_nombre }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $inscripcion->docente_nombre }}</h6>

                            <div class="dropdown float-end">
                                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opciones
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('consulta.notas', $inscripcion->id) }}">Notas</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('consulta.mensajes', $inscripcion->id) }}">Mensajes</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
