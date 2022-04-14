@extends('layout')

@section('title', 'Editar promotor')

@section('content')
    <div class="container-fluid">

        <!-- Cabecera -->
        <div class="d-sm-flex align-items-center justify-content-end m-2">
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#eliminar">
                Eliminar <i class="fas fa-trash ml-1"></i>
            </button>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">

                <!-- Datos del promotor -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">EDITAR PROMOTOR</h6>
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
