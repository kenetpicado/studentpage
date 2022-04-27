@extends('layout')

@section('title', 'Cambiar grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cambiar</li>
            </ol>
        </nav>
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">CAMBIAR GRUPO</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('grupos.cambiar', $pivot->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <p>Alumno:</p>
                            <p><strong>{{ $matricula->nombre }}</strong></p>
                            <p>Grupo actual:</p>

                            <p>
                                <strong>
                                    {{ $grupo->curso->nombre }} /
                                    {{ $grupo->horario }} /
                                    {{ $grupo->docente->nombre }}
                                </strong>
                            </p>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Seleccionar nuevo grupo</label>
                                    <select name="grupo_id" class="form-control @error('grupo_id') is-invalid @enderror">
                                        <option selected disabled value="">Seleccionar</option>
                                        @foreach ($grupos as $grupo)
                                            <option value="{{ $grupo->id }}">
                                                {{ $grupo->curso->nombre }} /
                                                {{ $grupo->horario }} /
                                                {{ $grupo->docente->nombre }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('grupo_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="oldgrupo" value="{{ $grupo_id }}">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
