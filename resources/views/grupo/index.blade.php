@extends('layout')

@section('title', 'Grupos')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grupos</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Grupos</h6>

                        @if (auth()->user()->rol == 'admin')
                            <div class="dropdown m-0">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('grupos.create') }}" class="dropdown-item">Crear grupo</a>
                                    <a href="{{ route('grupos.closed') }}" class="dropdown-item">Grupos terminados</a>
                                </div>
                            </div>
                        @endif

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
                                        @if (auth()->user()->rol == 'admin')
                                            <th>Editar</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                        <tr>
                                            <td>{{ $grupo->curso->nombre }} </td>
                                            <td>{{ $grupo->docente->nombre }}</td>
                                            <td>{{ $grupo->horario }}</td>
                                            <td>{{ $grupo->anyo }}</td>
                                            <td>
                                                <a href="{{ route('grupos.show', $grupo->id) }}"
                                                    class="btn btn-sm btn-primary btn-lg btn-block">
                                                    Ver {{ count($grupo->inscripciones) }}
                                                </a>
                                            </td>

                                            @if (auth()->user()->rol == 'admin')
                                                <td>
                                                    <a href="{{ route('grupos.edit', $grupo->id) }}"
                                                        class="btn btn-sm btn-outline-primary">Editar</a>
                                                </td>
                                            @endif
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
