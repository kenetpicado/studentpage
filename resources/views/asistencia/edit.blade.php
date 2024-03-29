@extends('layout')

@section('title', 'Editar asistencia')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Asistencias</li>
@endsection

@section('content')
    <x-header-0>Editar</x-header-0>

    <x-form ruta="asistencias.update">
        @method('PUT')
        <p>
            Editar asistencias del alumno:
        </p>
        <h5 class="fw-bolder">{{ $matricula->nombre }}</h5>
        <hr>
        <input type="hidden" name="grupo_id" value="{{ $inscripcion->grupo_id }}">
        <input type="hidden" name="matricula_id" value="{{ $inscripcion->matricula_id }}">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th class="text-center">Asistió</th>
                </tr>
            </thead>
            @forelse ($asistencias as $key => $asistencia)
                <tr>
                    <input type="hidden" name="asistencia_id[{{ $key }}]" value="{{ $asistencia->id }}">
                    <td>{{ $asistencia->created_at }}</td>
                    <td class="text-center">
                        <input type="hidden" name="present[{{ $key }}]" value="0">
                        @if ($asistencia->present == 1)
                            <div class="form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    name="present[{{ $key }}]" value="1" checked>
                            </div>
                        @else
                            <div class="form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    name="present[{{ $key }}]" value="1">
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No se han registrado asistencias</td>
                </tr>
            @endforelse
        </table>
    </x-form>
@endsection
