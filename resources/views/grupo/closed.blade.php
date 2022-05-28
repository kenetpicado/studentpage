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
                        <h6 class="m-0 font-weight-bold text-primary">GRUPOS TERMINADOS</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Curso</th>
                                        <th>Docente</th>
                                        <th>Horario</th>
                                        <th>Año</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $key => $grupo)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $grupo->curso->nombre }} </td>
                                            <td>{{ $grupo->docente->nombre }}</td>
                                            <td>{{ $grupo->horario }}</td>
                                            <td>{{ $grupo->anyo }}</td>
                                            <td>
                                                <a href="{{ route('grupos.show', $grupo->id) }}">
                                                    Ver {{ $grupo->inscripciones_count }} alumnos
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
