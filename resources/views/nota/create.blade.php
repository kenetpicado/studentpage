@extends('layout')

@section('title', 'Crear Nota')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $grupo->id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Notas</li>
@endsection

@section('content')
    <x-header-0>Crear Nota: {{ $grupo->nombre }} {{ $grupo->horario }}</x-header-0>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('notas.store') }}" method="post">
            @csrf
            <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
            <div class="row">
                <div class="mb-3 col-lg-3">
                    <label class="form-label">Modulo</label>
                    <select name="modulo_id" class="form-control @error('modulo_id') is-invalid @enderror" autofocus>

                        <option selected disabled value="">Seleccionar</option>

                        @foreach ($modulos as $modulo)
                            <option value="{{ $modulo->id }}" {{ old('modulo_id') == $modulo->id ? 'selected' : '' }}>
                                {{ $modulo->nombre }}
                            </option>
                        @endforeach

                    </select>

                    @error('modulo_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <table class="table table-borderless">
                <thead class="text-primary text-uppercase small">
                    <tr>
                        <th>Carnet</th>
                        <th>Nombre</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscripciones as $key => $inscripcion)
                        <tr>
                            <td>{{ $inscripcion->matricula_carnet }}</td>
                            <td>{{ $inscripcion->matricula_nombre }}</td>
                            <td>
                                <input type="hidden" name="inscripcion_id[{{ $key }}]"
                                    value="{{ $inscripcion->id }}">

                                <input type="number" class="form-control @error('valor.' . $key) is-invalid @enderror" name="valor[{{ $key }}]"
                                    value="{{ old('valor.' . $key, 0) }}" min="0" max="100" required>

                                @error('valor.' . $key)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary float-end">Guardar</button>
        </form>
    </div>
@endsection
