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
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">ALUMNOS</h6>
                        @if (count($grupo) > 0)
                            <div class="dropdown no-arrow">
                                <a href="{{ route('notas.reporte', $grupo_id) }}" class="btn btn-sm btn-primary ml-2"
                                    target="_blank">Reporte de notas</a>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Carnet</th>
                                        <th>Nombre</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupo as $alumno)
                                        <tr>
                                            <td>{{ $alumno->matricula->id }}</td>
                                            <td>{{ $alumno->matricula->carnet }}</td>
                                            <td>{{ $alumno->matricula->nombre }}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button"
                                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <a href="{{ route('notas.agregar', [$alumno->matricula->id, $grupo_id]) }}"
                                                            class="dropdown-item">Notas</a>
                                                        <a href="{{ route('pagos.pagar', [$alumno->matricula->id, $grupo_id]) }}"
                                                            class="dropdown-item">Pagos</a>
                                                        <a href="{{ route('grupos.seleccionar', [$alumno->matricula->id, $grupo_id]) }}"
                                                            class="dropdown-item">Cambiar de grupo</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
