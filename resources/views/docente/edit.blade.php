@extends('layout')

@section('title', 'Editar docente')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{route('docentes.index')}}">Docentes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

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
                        <form action="{{ route('docentes.update', $docente) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="nombre">Nombre del docente</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
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
                                    <input type="email" class="form-control @error('correo') is-invalid @enderror"
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
                                    <select name="estado" class="form-control">
                                        <option value="1"
                                            {{ old('estado') == '1' || $docente->estado == '1' ? 'selected' : '' }}>
                                            Activo</option>
                                        <option value="0"
                                            {{ old('estado') == '0' || $docente->estado == '0' ? 'selected' : '' }}>
                                            Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="docente_id" value="{{$docente->id}}">
                            <button type="submit" class="btn btn-primary">Guardar</button>
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
