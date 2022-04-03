@extends('layout')

@section('title', 'Ver matriculas')

@section('content')
    <div class="container-fluid">

        <!-- Boton abrir modal -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Matriculas</h1>
            <button type="button" class="btn btn-secondary ml-2" data-toggle="modal" data-target="#matriculaModalCreate">
                Agregar <i class="fas fa-plus ml-1"></i>
            </button>
        </div>

        @include('matricula.modal')

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">VER MATRICULAS</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Carnet</th>
                                        <th>Curso</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matriculas as $matricula)
                                        <tr>
                                            <td>{{ $matricula->id }}</td>
                                            <td>{{ $matricula->nombre }}</td>
                                            <td><strong>{{ $matricula->carnet }}</strong></td>
                                            <td>{{ $matricula->grupo->curso->nombre }}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{-- <i class="fas fa-exclamation-circle fa-sm fa-fw text-gray-400"></i> --}}
                                                        Ver opciones <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        {{-- <a class="dropdown-item" href="{{ route('prematricula.edit', $matricula->prematricula) }}">Editar</a> --}}
                                                        <a class="dropdown-item"
                                                            href="{{ route('matricula.show', $matricula) }}">Ver
                                                            detalles</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('pago.estudiante', $matricula) }}">Ver
                                                            pagos</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('matricula.edit', $matricula) }}">Editar</a>

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

@section('re-open')
    @if ($errors->any())
        <script>
            $('#matriculaModalCreate').modal('show')
        </script>
    @endif
@endsection
