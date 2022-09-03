@extends('layout')

@section('title', 'Grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
@endsection

@section('content')
    <x-header-2 text="Todos los Alumnos">
        <a href="{{ route('mensajes.index', ['grupo', $grupo_id]) }}" class="dropdown-item">
            Mensajes
        </a>
        <a href="{{ route('notas.create', $grupo_id) }}" class="dropdown-item">
            Registrar Notas
        </a>
        <a href="{{ route('asistencias.index', $grupo_id) }}" class="dropdown-item">
            Registrar Asistencia
        </a>
        @if (count($inscripciones))
            <hr class="dropdown-divider">
            <a href="{{ route('notas.show', $grupo_id) }}" class="dropdown-item" target="_blank">
                Reporte Notas</a>
            <a href="{{ route('asistencias.show', $grupo_id) }}" class="dropdown-item" target="_blank">
                Reporte Asistencias
            </a>
        @endif
    </x-header-2>

    <x-table-head>
        <x-slot name="title">
            <th>Nombre</th>
            <th>Carnet</th>
            <th>Notas</th>
            <th>Asistencias</th>
            @if (auth()->user()->rol == 'admin')
                <th>Editar</th>
            @endif
        </x-slot>
        <tbody>
            @foreach ($inscripciones as $inscripcion)
                <tr>
                    <td>{{ $inscripcion->matricula_nombre }}</td>
                    <td>{{ $inscripcion->matricula_carnet }}</td>
                    <td><a class="btn btn-sm btn-primary" href="{{ route('notas.index', $inscripcion->id) }}">Notas</a></td>
                    <td><a class="btn btn-sm btn-primary" href="{{ route('asistencias.edit', $inscripcion->id) }}">Asistencias</a>
                    </td>
                    @if (auth()->user()->rol == 'admin')
                        <td><a class="btn btn-sm btn-outline-primary"
                                href="{{ route('inscripciones.edit', $inscripcion->id) }}">Editar</a>
                        </td>
                    @endif

                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
