@extends('layout')

@section('title', 'Grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Alumnos</h6>

                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                @if (count($alumnos) > 0)
                                    <a href="{{ route('notas.show', $grupo_id) }}" class="dropdown-item"
                                        target="_blank">Reporte de notas</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Carnet</th>
                                        <th>Nombre</th>
                                        <th>Notas</th>
                                        @if (auth()->user()->rol == 'admin')
                                            <th>Pagos</th>
                                            <th>Editar</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alumnos as $alumno)
                                        <tr>
                                            <td>{{ $alumno->matricula->carnet }}</td>
                                            <td>{{ $alumno->matricula->nombre }}</td>
                                            <td>
                                                <a href="{{ route('notas.create', [$alumno->matricula->id, $grupo_id]) }}"
                                                    class="btn btn-sm btn-outline-primary">Notas</a>
                                            </td>
                                            @if (auth()->user()->rol == 'admin')
                                                <td>
                                                    <a href="{{ route('pagos.create', [$alumno->matricula->id, $grupo_id]) }}"
                                                        class="btn btn-sm btn-outline-success">Pagos</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('inscripciones.edit', [$alumno->matricula->id, $grupo_id]) }}"
                                                        class="btn btn-sm btn-primary">Editar</a>
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
