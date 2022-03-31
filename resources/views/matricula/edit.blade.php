@extends('layout')

@section('title', 'Editar matrícula')

@section('content')
    <div class="container-fluid">

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
                            <div class="form-group col-lg-6">
                                <label for="manual">Manual de usuario</label>
                                <select name="manual" class="form-control is-valid">
                                    @if ($matricula->manual == 'NO')
                                        <option selected value="NO">NO</option>
                                        <option value="SI">SI</option>
                                    @else
                                        <option value="NO">NO</option>
                                        <option selected value="SI">SI</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="grupo_id">Seleccionar curso y grupo</label>
                                <select name="grupo_id" class="form-control is-valid @error('grupo_id') is-invalid @enderror">
                                    <option disabled value="">Seleccionar</option>
                                    @foreach ($grupos as $grupo)
                                        @if ($matricula->grupo_id == $grupo->id)
                                            <option selected value="{{ $grupo->id }}"
                                                {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                                {{ $grupo->curso->nombre }} -
                                                {{ $grupo->numero }}
                                            </option>
                                        @else
                                            <option value="{{ $grupo->id }}"
                                                {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                                {{ $grupo->curso->nombre }} -
                                                {{ $grupo->numero }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('grupo_id')
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
