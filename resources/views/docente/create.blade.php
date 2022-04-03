@extends('layout')

@section('title', 'Docentes')

@section('content')
    <div class="container-fluid">

        <!-- Boton abrir modal -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Docentes</h1>
            <button type="button" class="btn btn-secondary ml-2" data-toggle="modal" data-target="#docenteModalCreate">
                Agregar <i class="fas fa-plus ml-1"></i>
            </button>
        </div>
        
        <!-- Docente Modal -->
        <div class="modal fade" id="docenteModalCreate" tabindex="-1" role="dialog" aria-labelledby="docenteModalCreate"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">AGREGAR UN NUEVO DOCENTE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="" action="{{ route('docente.store') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre del docente</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                    autocomplete="off" value="{{ old('nombre') }}">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
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

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">TODOS LOS DOCENTES</h6>
                    </div>

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">TODOS los docentes registrados:</div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Carnet</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($docentes as $docente)
                                        <tr>
                                            <td>{{ $docente->id }}</td>
                                            <td>{{ $docente->carnet }}</td>
                                            <td>{{ $docente->nombre }}</td>
                                            <td>{{ $docente->correo }}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ver opciones <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">

                                                        <a href="{{ route('docente.grupos', $docente->id) }}" class="dropdown-item">Ver grupos</a>
                                                        <a href="{{ route('docente.edit', $docente->id) }}" class="dropdown-item">Editar</a>

                                                        {{-- SI NO TIENE RELACION CON ALGUN GRUPO SE MUESTRA ELIMINAR --}}
                                                        @if (count($docente->grupos) == 0)
                                                        <div class="dropdown-divider"></div>
                                                            <form class="dropdown-item eliminar d-sm-flex"
                                                                action="{{ route('docente.destroy', $docente->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <i class="fas fa-trash m-auto"></i>
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

@section('re-open')
    @if ($errors->any())
        <script>
            $('#docenteModalCreate').modal('show')
        </script>
    @endif
@endsection
