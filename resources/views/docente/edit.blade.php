@extends('layout')

@section('title', 'Editar docente')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos-->
                <div class="card shadow mb-4">
                    
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">EDITAR DOCENTE: {{ $docente->carnet }}</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Opciones:</div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#restablecer">Restablecer PIN</a>
                                @if (count($docente->grupos) == 0)
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#eliminar">Eliminar</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('docente.update', $docente) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="nombre">Nombre del docente</label>
                                    <input type="text" class="form-control is-valid @error('nombre') is-invalid @enderror"
                                        name="nombre" autocomplete="off" value="{{ old('nombre', $docente->nombre) }}">

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
                                    <input type="email" class="form-control is-valid @error('correo') is-invalid @enderror"
                                        name="correo" autocomplete="off" value="{{ old('correo', $docente->correo) }}">

                                    @error('correo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Estado</label>
                                    <select name="estado" class="form-control is-valid">
                                        <option value="1"
                                            {{ old('estado') == '1' || $docente->estado == '1' ? 'selected' : '' }}>
                                            Activo</option>
                                        <option value="0"
                                            {{ old('estado') == '0' || $docente->estado == '0' ? 'selected' : '' }}>
                                            Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')

@section('agregarModal')
    @include('docente.modal')
@endsection
