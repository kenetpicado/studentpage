@extends('layout')

@section('title', 'Cursos')

@section('content')
    <div class="container-fluid">

        {{-- Boton abrir modal --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cursos</h1>
            <button type="button" class="btn btn-secondary ml-2" data-toggle="modal" data-target="#cursoModalCreate">
                Agregar <i class="fas fa-plus ml-1"></i>
            </button>
        </div>

        <!-- Curso Modal -->
        <div class="modal fade" id="cursoModalCreate" tabindex="-1" role="dialog" aria-labelledby="cursoModalCreate"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">AGREGAR UN NUEVO CURSO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('curso.store') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre del curso</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                    autocomplete="off" value="{{ old('nombre') }}">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos del alumno -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">TODOS LOS CURSOS</h6>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">TODOS los cursos disponibles:</div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre del curso</th>
                                        <th>Estado</th>
                                        <th>Grupos</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cursos as $curso)
                                        <tr>
                                            <td>{{ $curso->id }}</td>
                                            <td>{{ $curso->nombre }}</td>
                                            <td>
                                                @if ($curso->estado == '1')
                                                    <span class="badge badge-pill badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-success">
                                                    {{ count($curso->grupos) }}
                                                </span>
                                            </td>

                                            <td class="center-babe">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{-- <i class="fas fa-exclamation-circle fa-sm fa-fw text-gray-400"></i> --}}
                                                        Ver opciones <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">

                                                        <a href="{{ route('curso.grupos', $curso->id) }}"
                                                            class="dropdown-item">Ver grupos</a>
                                                        <a href="{{ route('curso.edit', $curso->id) }}"
                                                            class="dropdown-item">Editar</a>

                                                        <div class="dropdown-divider"></div>


                                                        <form class="dropdown-item estado d-sm-flex"
                                                            action="{{ route('curso.estado', $curso->id) }}" method="get">
                                                            <i class="fas fa-exchange-alt m-auto"></i>
                                                            <input type="submit" class="dropdown-item"
                                                                value="Cambiar estado">
                                                        </form>

                                                        {{-- SI NO TIENE RELACION CON ALGUN GRUPO SE MUESTRA ELIMINAR --}}
                                                        @if (count($curso->grupos) == 0)
                                                            <form class="dropdown-item eliminar d-sm-flex"
                                                                action="{{ route('curso.destroy', $curso->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <i class="fas fa-trash m-auto"></i>
                                                                <input type="submit" class="dropdown-item"
                                                                    value="Eliminar curso">
                                                            </form>
                                                        @endif
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
            $('#cursoModalCreate').modal('show')
        </script>
    @endif
@endsection
