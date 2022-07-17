@extends('layout')

@section('title', 'Grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
@endsection

@section('content')
    <x-header-2 text="Alumnos">
        <a href="{{ route('mensajes.index', $grupo_id) }}" class="dropdown-item">
            Mensajes
        </a>
        @if (count($inscripciones))
            <a href="{{ route('notas.show', $grupo_id) }}" class="dropdown-item" target="_blank">
                Reporte de notas</a>
        @endif
    </x-header-2>

    <x-table-head>
        <x-slot name="title">
            <th>Carnet</th>
            <th>Nombre</th>
            <th>Notas</th>
            @if (auth()->user()->rol == 'admin')
                <th>Pagos</th>
                <th>Mover</th>
            @endif
        </x-slot>
        <tbody>
            @foreach ($inscripciones as $inscripcion)
                <tr>
                    <td>{{ $inscripcion->matricula_carnet }}</td>
                    <td>{{ $inscripcion->matricula_nombre }}</td>
                    <td>
                        <a href="{{ route('notas.index', $inscripcion->id) }}" class="btn btn-sm btn-primary">Notas</a>
                    </td>
                    @if (auth()->user()->rol == 'admin')
                        <td>
                            <a href="{{ route('pagos.index', $inscripcion->id) }}"
                                class="btn btn-sm btn-secondary">Pagos</a>
                        </td>
                        <td>
                            <a href="{{ route('inscripciones.edit', $inscripcion->id) }}"
                                class="btn btn-sm btn-outline-primary">Mover</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
