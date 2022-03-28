@extends('layout')

@section('title', 'Centro')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-12" action="{{ route('centro.store') }}" method="POST">
                @csrf
                <!-- Datos del alumno -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">AGREGAR DATOS DEL CENTRO DE ESTUDIO</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nombre">Nombre del centro</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                    autocomplete="off" value="{{ old('nombre') }}">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="tel">Teléfono</label>
                                <input type="number" class="form-control @error('tel') is-invalid @enderror" name="tel"
                                    autocomplete="off" value="{{ old('tel') }}" placeholder="00000000">

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>  
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="departamento">Departamento</label>
                                <input type="text" class="form-control @error('departamento') is-invalid @enderror"
                                    name="departamento" autocomplete="off" value="{{ old('departamento') }}">

                                @error('departamento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="municipio">Municipio</label>
                                <input type="text" class="form-control @error('municipio') is-invalid @enderror"
                                    name="municipio" value="{{ old('municipio') }}" autocomplete="off">

                                @error('municipio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                    name="direccion" value="{{ old('direccion') }}" autocomplete="off">

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-2 py-0 border-left-primary">
                            <div class="card-body">
                                Verifique que la información proporcionada sea correcta.
                                <br>
                                Estos datos no deberían editarse a menos que sea estrictamente necesario.
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
