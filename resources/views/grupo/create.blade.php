@extends('layout')

@section('title', 'Crear grupo')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-12" action="{{ route('grupo.store') }}" method="POST">
                @csrf
                <!-- Datos del alumno -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">CREAR GRUPO</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="curso_id">Curso</label>
                                <select name="curso_id" class="form-control @error('curso_id') is-invalid @enderror">
                                    <option selected disabled value="">Seleccionar</option>
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}"
                                            {{ old('curso_id') == $curso->id ? 'selected' : '' }}>{{ $curso->id }} -
                                            {{ $curso->nombre }}</option>
                                    @endforeach
                                </select>

                                @error('curso_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="docente_id">Docente</label>
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
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="numero">Número</label>
                                <select name="numero" class="form-control @error('numero') is-invalid @enderror">
                                    <option disabled selected value="">Seleccionar</option>
                                    @for ($i = 1; $i < 5; $i++)
                                        <option value="GP{{ $i }}"
                                            {{ old('numero') == 'GP' . $i ? 'selected' : '' }}>GP{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('numero')
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
