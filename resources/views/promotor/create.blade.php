@extends('layout')

@section('title', 'Crear promotor')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7" action="{{ route('promotor.store') }}" method="POST">
                @csrf
                <!-- Datos del promotor -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">AGREGAR PROMOTOR</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="nombre">Nombre completo</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                    autocomplete="off" value="{{ old('nombre') }}">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control @error('correo') is-invalid @enderror" name="correo"
                                    autocomplete="off" value="{{ old('correo') }}">

                                @error('correo')
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

                <!-- Datos  -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">TODOS LOS PROMOTORES</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Carnet</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promotors as $promotor)
                                        <tr>
                                            <td>{{ $promotor->id }}</td>
                                            <td>{{ $promotor->carnet }}</td>
                                            <td>{{ $promotor->nombre }}</td>
                                            <td>{{ $promotor->correo }}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{-- <i class="fas fa-exclamation-circle fa-sm fa-fw text-gray-400"></i> --}}
                                                        Ver opciones <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">

                                                        <form class="dropdown-item"
                                                            action="{{ route('promotor.edit', $promotor->id) }}"
                                                            method="get">
                                                            <input type="submit" class="dropdown-item" value="Editar">
                                                        </form>

                                                        <form class="dropdown-item eliminar"
                                                            action="{{ route('promotor.destroy', $promotor->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" class="dropdown-item"
                                                                value="Eliminar promotor">
                                                        </form>
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
