@extends('layout')

@section('title', 'Editar matrícula')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('matricula.index') }}">Matriculas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7" action="{{ route('matricula.update', $matricula->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Datos-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">EDITAR MATRICULA</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nombre">Nombre completo</label>
                                <input type="text" class="form-control is-valid @error('nombre') is-invalid @enderror" name="nombre"
                                    autocomplete="off" value="{{ old('nombre', $matricula->nombre) }}">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="cedula">Cédula</label>
                                <input type="text" class="form-control is-valid @error('cedula') is-invalid @enderror" name="cedula"
                                    autocomplete="off" value="{{ old('cedula', $matricula->cedula) }}"
                                    placeholder="000-000000-00000">

                                @error('cedula')
                                    <span class="  invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="fecha_nac">Fecha de nacimiento</label>
                                <input type="date" class="form-control is-valid @error('fecha_nac') is-invalid @enderror"
                                    name="fecha_nac" value="{{ old('fecha_nac', $matricula->fecha_nac) }}">

                                @error('fecha_nac')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tel">Teléfono</label>
                                <input type="number" class="form-control is-valid @error('tel') is-invalid @enderror" name="tel"
                                    autocomplete="off" value="{{ old('tel', $matricula->tel) }}" placeholder="00000000">

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="  row">
                            <div class="form-group col-lg-6">
                                <label for="madre">Nombre de la Madre</label>
                                <input type="text" class="form-control is-valid" name="madre" autocomplete="off"
                                    value="{{ old('madre', $matricula->madre) }}">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="padre">Nombre del Padre</label>
                                <input type="text" class="form-control is-valid" name="padre" autocomplete="off"
                                    value="{{ old('padre', $matricula->padre) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="grado">Último grado aprobado</label>
                                <input type="text" class="form-control is-valid @error('grado') is-invalid @enderror" name="grado"
                                    autocomplete="off" value="{{ old('grado', $matricula->grado) }}">

                                @error('grado')
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
