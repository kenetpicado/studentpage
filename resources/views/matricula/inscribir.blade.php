@extends('layout')

@section('title', 'Inscribir')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('matricula.index') }}">Matriculas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Inscribir</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos-->
                <div class="card shadow mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">INSCRIBIR</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('matricula.update', $matricula) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    A continuación, se muestran los cursos disponibles en función de la
                                    sucursal asignada al estudiante.
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Selecionar grupo</label>
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
                            <input type="hidden" name="inscribir">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
