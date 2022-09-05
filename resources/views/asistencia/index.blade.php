@extends('layout')

@section('title', 'Asistencia de grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('grupos.show', $grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Asistencia</li>
@endsection

@section('content')
    <x-header-0>Asistencia</x-header-0>

    <x-form ruta="asistencias.store">
        <p>
            Registrar asistencia del grupo:
        </p>
        <h5 class="fw-bolder">{{ $grupo->nombre }} {{ $grupo->horario }}</h5>
        <hr>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Asistió</th>
                </tr>
            </thead>
            @foreach ($inscripciones as $key => $inscripcion)
                <tr>
                    <td>{{ $inscripcion->matricula_nombre }}</td>
                    <td>
                        <input type="hidden" name="inscripcion_id[{{ $key }}]"
                            value="{{ $inscripcion->id }}">

                        <input type="hidden" name="matricula_id[{{ $key }}]"
                            value="{{ $inscripcion->matricula_id }}">

                        <input type="hidden" name="present[{{ $key }}]" value="0">

                        <div class="form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                name="present[{{ $key }}]" value="1">
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <x-input name="created_at" label="Fecha" type="date" :val="date('Y-m-d')"></x-input>
        <input type="hidden" name="grupo_id" value="{{ $grupo_id }}">
    </x-form>
@endsection
