@extends('layout')

@section('title', 'Crear promotor')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7" action="{{ route('promotor.update', $promotor) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Datos del promotor -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">EDITAR PROMOTOR</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="nombre">Nombre completo</label>
                                <input type="text" class="form-control is-valid @error('nombre') is-invalid @enderror" name="nombre"
                                    autocomplete="off" value="{{ old('nombre', $promotor->nombre) }}">

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
                                <input type="email" class="form-control is-valid @error('correo') is-invalid @enderror" name="correo"
                                    autocomplete="off" value="{{ old('correo', $promotor->correo) }}">

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
    </div>
@endsection('content')