@extends('layout')

@section('title', 'Grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.thisClosed', $grupo_id) }}">Terminados</a></li>
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
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Carnet</th>
                                        <th>Nombre</th>
                                        <th>Notas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alumnos as $key => $alumno)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $alumno->matricula->carnet }}</td>
                                            <td>{{ $alumno->matricula->nombre }}</td>
                                            <td><a href="{{ route('notas.certified', [$alumno->matricula->id, $grupo_id]) }}">Ver
                                                    certicado</a></td>
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
