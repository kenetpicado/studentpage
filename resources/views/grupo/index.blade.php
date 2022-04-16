@extends('layout')

@section('title', 'Grupos')

@section('content')
    <div class="container-fluid">

        <!-- Cabecera -->
        <div class="d-sm-flex align-items-center justify-content-between m-2">
            <h1 class="h3 mb-0 text-gray-800">Grupos</h1>
            <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#grupoModalCreate">
                Agregar <i class="fas fa-plus ml-1"></i>
            </button>
        </div>

        @include('grupo.modal')

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">TODOS LOS GRUPOS</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Grupo</th>
                                        <th>Sucursal</th>
                                        <th>Año</th>
                                        <th>Horario</th>
                                        <th>Docente</th>
                                        <th>Alumnos</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                        <tr>
                                            <td>{{ $grupo->curso->nombre ?? '' }}</td>
                                            <td>{{ $grupo->numero }}</td>
                                            <td>{{ $grupo->sucursal }}</td>
                                            <td>{{ $grupo->anyo }}</td>
                                            <td>{{ $grupo->horario }}</td>
                                            <td>{{ $grupo->docente->nombre }}</td>
                                            <td>{{ count($grupo->matriculas) }}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-tasks"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <a href="{{ route('grupo.show', $grupo) }}"
                                                            class="dropdown-item">Ver alumnos</a>
                                                        <a href="{{ route('grupo.edit', $grupo) }}"
                                                            class="dropdown-item">Editar</a>
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
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')

@section('re-open')
    @if ($errors->any())
        <script>
            $('#grupoModalCreate').modal('show')
        </script>
    @endif
@endsection
