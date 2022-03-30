@extends('layout')

@section('title', 'Cursos')

@section('content')
    <div class="container-fluid">



        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7" action="{{ route('curso.store') }}" method="POST">
                @csrf
                <!-- Datos-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">AGREGAR UN NUEVO CURSO</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
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
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Content Row -->

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
                                                    <i class="fas fa-circle" style="color:green"></i>
                                                    Activo
                                                @else
                                                    <i class="fas fa-circle"></i>
                                                    Inactivo
                                                @endif
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

                                                        <form class="dropdown-item"
                                                            action="{{ route('curso.grupos', $curso->id) }}" method="get">
                                                            <input type="submit" class="dropdown-item" value="Ver grupos">
                                                        </form>

                                                        <form class="dropdown-item"
                                                            action="{{ route('curso.edit', $curso->id) }}" method="get">
                                                            <input type="submit" class="dropdown-item"
                                                                value="Editar nombre">
                                                        </form>

                                                        <form class="dropdown-item estado"
                                                            action="{{ route('curso.estado', $curso->id) }}" method="get">
                                                            <input type="submit" class="dropdown-item"
                                                                value="Cambiar estado">
                                                        </form>

                                                        {{-- SI NO TIENE RELACION CON ALGUN GRUPO SE MUESTRA ELIMINAR --}}
                                                        @if (count($curso->grupos) == 0)
                                                            <form class="dropdown-item eliminar"
                                                                action="{{ route('curso.destroy', $curso->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
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
