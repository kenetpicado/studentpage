@extends('layout')

@section('title', 'Editar promotor')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">

                <!-- Datos del promotor -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">EDITAR PROMOTOR: {{ $promotor->carnet }}</h6>
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
                                @if (count($promotor->matriculas) == 0)
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#eliminar">Eliminar</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('promotor.update', $promotor) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6>Carnet: <strong>{{ $promotor->carnet }}</strong> </h6>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="nombre">Nombre completo</label>
                                    <input type="text" class="form-control is-valid @error('nombre') is-invalid @enderror"
                                        name="nombre" autocomplete="off" value="{{ old('nombre', $promotor->nombre) }}">

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
                                        name="correo" autocomplete="off" value="{{ old('correo', $promotor->correo) }}">

                                    @error('correo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

@section('agregarModal')
    @include('promotor.modal')
@endsection
