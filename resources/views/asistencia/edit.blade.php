@extends('layout')

@section('title', 'Editar asistencia')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar asistencias</li>
@endsection

@section('content')
    <x-header-0>Asistencia</x-header-0>

    <x-create-form ruta="asistencias.update">
        @method('PUT')
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Asistió</th>
                </tr>
            </thead>
            @foreach ($asistencias as $key => $asistencia)
                <tr>
                    <input type="hidden" name="asistencia_id[{{ $key }}]" value="{{ $asistencia->id }}">

                    <td>{{ $asistencia->created_at }}</td>
                    <td>
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
            @endforeach
        </table>
    </x-create-form>
@endsection
