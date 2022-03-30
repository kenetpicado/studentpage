@extends('layout')

@section('title', 'Docentes')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7" action="{{ route('docente.store') }}" method="POST">
                @csrf
                <!-- Datos-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">AGREGAR UN NUEVO DOCENTE</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="nombre">Nombre del docente</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                    autocomplete="off" value="{{old('nombre')}}">

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

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">TODOS LOS DOCENTES</h6>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">TODOS los docentes registrados:</div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Carnet</th>
                                        <th>PIN</th>
                                        <th>Nombre</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($docentes as $docente)
                                        <tr>
                                            <td>{{ $docente->id }}</td>
                                            <td>{{ $docente->carnet }}</td>
                                            <td>{{ $docente->pin }}</td>
                                            <td>{{ $docente->nombre }}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ver opciones <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">

                                                        <form class="dropdown-item"
                                                            action="{{route('docente.grupos', $docente->id)}}" method="get">
                                                            <input type="submit" class="dropdown-item"
                                                                value="Ver grupos">
                                                        </form>

                                                        <form class="dropdown-item"
                                                            action="{{route('docente.edit', $docente->id)}}" method="get">
                                                            <input type="submit" class="dropdown-item"
                                                                value="Editar nombre">
                                                        </form>

                                                        {{-- SI NO TIENE RELACION CON ALGUN GRUPO SE MUESTRA ELIMINAR --}}
                                                        @if (count($docente->grupos) == 0)
                                                            <form class="dropdown-item eliminar"
                                                                action="{{ route('docente.destroy', $docente->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="submit" class="dropdown-item"
                                                                    value="Eliminar docente">
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
