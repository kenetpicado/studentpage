@extends('layout')

@section('title', 'Cambiar profesor')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-12" action="{{ route('grupo.update', $grupo) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Datos del alumno -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">CAMBIAR PROFESOR</h6>
                    </div>
                    <div class="card-body">
                        <p>
                            Curso: <strong>{{$grupo->curso->nombre}}</strong>
                        </p>
                        <p>
                            Grupo: <strong>{{$grupo->numero}}</strong>
                        </p>
                        <p>
                            Docente anterior: <strong>{{$grupo->docente->nombre}}</strong>
                        </p>
                        <hr>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="docente_id">Selecionar nuevo docente</label>
                                <select name="docente_id" class="form-control @error('docente_id') is-invalid @enderror">
                                    <option selected disabled value="">Seleccionar</option>
                                    @foreach ($docentes as $docente)
                                        <option value="{{ $docente->id }}"
                                            {{ old('docente_id') == $docente->id ? 'selected' : '' }}>{{ $docente->id }}
                                            - {{ $docente->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('docente_id')
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
