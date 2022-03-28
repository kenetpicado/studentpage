@extends('layout')

@section('title', 'Ver matriculas')

@section('content')
    <div class="container-fluid">
        {{-- SI HAY MENSAJE DE CONFIRMACION --}}
        @if (session('info'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-primary text-white shadow mb-2">
                        <div class="card-body">
                            {{ session('info') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos del alumno -->
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
                                        <th>Manual</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matriculas as $matricula)
                                        <tr>
                                            <td>{{ $matricula->id }}</td>
                                            <td>{{ $matricula->prematricula->nombre }}</td>
                                            <td>
                                                <a href="{{ route('matricula.show', $matricula) }}">
                                                    <strong>{{ $matricula->carnet }}</strong>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('matricula.edit', $matricula) }}">{{ $matricula->manual }}
                                                    <i class="bi bi-pencil-square"></i></a>
                                            </td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{-- <i class="fas fa-exclamation-circle fa-sm fa-fw text-gray-400"></i> --}}
                                                        Ver opciones <i class="fas fa-thumbs-up"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="{{ route('prematricula.edit', $matricula->prematricula) }}">Editar</a>
                                                        <a class="dropdown-item" href="">Opcion 2</a>
                                                        <a class="dropdown-item" href="">Opcion 3</a>
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
