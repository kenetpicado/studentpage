@extends('layout')

@section('title', 'Editar centro')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-12" action="{{ route('centro.update', $centro) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Datos del alumno -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">EDITAR DATOS DEL CENTRO DE ESTUDIO</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nombre">Nombre del centro</label>
                                <input type="text" class="form-control is-valid @error('nombre') is-invalid @enderror" name="nombre"
                                    autocomplete="off" value="{{ old('nombre', $centro->nombre) }}">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="tel">Teléfono</label>
                                <input type="number" class="form-control is-valid @error('tel') is-invalid @enderror" name="tel"
                                    autocomplete="off" value="{{ old('tel', $centro->tel) }}" placeholder="00000000">

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
                                <input type="text" class="form-control is-valid @error('departamento') is-invalid @enderror"
                                    name="departamento" autocomplete="off" value="{{ old('departamento', $centro->departamento) }}">

                                @error('departamento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="municipio">Municipio</label>
                                <input type="text" class="form-control is-valid @error('municipio') is-invalid @enderror"
                                    name="municipio" value="{{ old('municipio', $centro->municipio) }}" autocomplete="off">

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
                                <input type="text" class="form-control is-valid @error('direccion') is-invalid @enderror"
                                    name="direccion" value="{{ old('direccion', $centro->direccion) }}" autocomplete="off">

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
