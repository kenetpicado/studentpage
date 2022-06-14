@extends('layout')

@section('title', 'Editar matrícula')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos-->
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Editar</h6>
                        @if (count($matricula->inscripciones) < 1)
                            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#eliminar">
                                <i class="fas fa-trash"></i>
                            </a>

                            <!-- Elimiar-->
                            <div class="modal fade" id="eliminar" tabindex="1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                                            <button class="close" type="button" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <p>
                                                    ¿Está seguro que desea eliminar este registro?
                                                    Esta acción no se puede deshacer.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <form action="{{ route('matriculas.update', $matricula->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nombre">Nombre completo</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        name="nombre" autocomplete="off" autofocus
                                        value="{{ old('nombre', $matricula->nombre) }}">

                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="fecha_nac">Fecha de nacimiento</label>
                                    <input type="date" class="form-control @error('fecha_nac') is-invalid @enderror"
                                        name="fecha_nac" value="{{ old('fecha_nac', $matricula->fecha_nac) }}">

                                    @error('fecha_nac')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="cedula">Cédula</label>
                                    <input type="text" class="form-control @error('cedula') is-invalid @enderror"
                                        name="cedula" autocomplete="off" value="{{ old('cedula', $matricula->cedula) }}">

                                    @error('cedula')
                                        <span class="  invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="grado">Último grado aprobado</label>
                                    <input type="text" class="form-control @error('grado') is-invalid @enderror"
                                        name="grado" autocomplete="off" value="{{ old('grado', $matricula->grado) }}">

                                    @error('grado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="tutor">Tutor</label>
                                    <input type="text" class="form-control" name="tutor" autocomplete="off"
                                        value="{{ old('tutor', $matricula->tutor) }}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="tel">Teléfono</label>
                                    <input type="number" class="form-control @error('tel') is-invalid @enderror" name="tel"
                                        autocomplete="off" value="{{ old('tel', $matricula->tel) }}">

                                    @error('tel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
