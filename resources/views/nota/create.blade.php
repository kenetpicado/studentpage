@extends('layout')

@section('title', 'Crear Nota')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $grupo->id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Notas</li>
@endsection

@section('content')
    <x-header-0>Notas</x-header-0>
    <x-form ruta="notas.store">
        <p>
            Registrar notas del grupo:
        </p>
        <h5 class="fw-bolder">{{ $grupo->nombre }} {{ $grupo->horario }}</h5>
        <hr>
        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
        <div class="row">
            <div class="col-lg-6">
                <x-select :items="$modulos" name="modulo_id" text="Módulo"></x-select>
            </div>
            <p class="text-muted small">
                Por favor, asegúrese de seleccionar el módulo correcto. Si selecciona un módulo que ya ha sido
                registrado, la(s) nota(s) se actualizarán.
            </p>
        </div>

        <x-table>
            @slot('title')
                <th>Enviar</th>
                <th>Nombre</th>
                <th>Nota</th>
            @endslot
            @forelse ($inscripciones as $key => $inscripcion)
                <tr>
                    <td data-title="Enviar">
                        <input type="hidden" name="enviar[{{ $key }}]" value="0">

                        <div class="form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                name="enviar[{{ $key }}]" value="1" checked>
                        </div>
                    </td>
                    <td data-title="Nombre">
                        <div class="small text-primary opacity-75">{{ $inscripcion->matricula_carnet }}</div>
                        {{ $inscripcion->matricula_nombre }}
                    </td>
                    <td data-title="Nota">
                        <input type="hidden" name="inscripcion_id[{{ $key }}]" value="{{ $inscripcion->id }}">

                        <input type="number" class="form-control @error('valor.' . $key) is-invalid @enderror"
                            name="valor[{{ $key }}]" value="{{ old('valor.' . $key, 0) }}" min="0"
                            max="100" required>

                        @error('valor.' . $key)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                </tr>
            @empty
                <tr>
                    <td>No hay registros</td>
                </tr>
            @endforelse
            @slot('links')
            @endslot
        </x-table>
    </x-form>
@endsection
