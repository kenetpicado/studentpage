@extends('layout')

@section('title', 'Cambiar grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cambiar</li>
            </ol>
        </nav>
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cambiar Grupo</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('inscripciones.update', $inscripcion->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <p>
                                        Mover estudiante del grupo actual seleccionado. También se moverán todos los
                                        registros de Notas y Pagos del alumno en este grupo.
                                    </p>
                                    <select name="grupo_id" class="form-control @error('grupo_id') is-invalid @enderror">
                                        <option selected disabled value="">Seleccionar</option>
                                        @foreach ($grupos as $grupo)
                                            <option value="{{ $grupo->id }}"
                                                {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
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
                            <input type="hidden" name="matricula_id" value="{{ $inscripcion->matricula_id }}">
                            <input type="hidden" name="oldview" value="{{ $inscripcion->grupo_id }}">
                            <button type="submit" class="btn btn-primary">Cambiar</button>
                        </form>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Eliminar Inscripción</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('inscripciones.destroy', $inscripcion->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <p>Eliminar estudiante del grupo actual seleccionado. Debe tener en cuenta que esta
                                        opción eliminará todos los registros de Notas y Pagos del alumno en este grupo.
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" name="grupo" value="{{$inscripcion->grupo_id}}">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
