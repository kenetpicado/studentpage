@extends('layout')

@section('title', 'Grupos terminados')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terminados</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Terminados</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Docente</th>
                                        <th>Horario</th>
                                        <th>Año</th>
                                        <th>Alumnos</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                        <tr>
                                            <td>
                                                <i class="fas fa-exclamation-circle" style="color:tomato"></i>
                                                {{ $grupo->curso->nombre }}
                                            </td>
                                            <td>{{ $grupo->docente->nombre }}</td>
                                            <td>{{ $grupo->horario }}</td>
                                            <td>{{ $grupo->anyo }}</td>
                                            <td>
                                                <a href="{{ route('grupos.thisClosed', $grupo->id) }}">
                                                    Ver ({{ $grupo->inscripciones_count }})
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('grupos.status', $grupo->id) }}">Reactivar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
