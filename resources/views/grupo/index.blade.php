@extends('layout')

@section('title', 'Grupos')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Grupos</li>
@endsection

@section('content')
    @if (auth()->user()->rol == 'admin')
        <x-header-2 text="Grupos">
            <a class="dropdown-item" href="{{ route('grupos.create') }}">Crear grupo</a>
            <a class="dropdown-item" href="{{ route('grupos.closed') }}">Grupos terminados</a>
        </x-header-2>
    @else
        <x-header-0>Grupos</x-header-0>
    @endif

    <x-table-head>
        <x-slot name="title">
            <th>Curso</th>
            <th>Docente</th>
            <th>Horario</th>
            <th>Año</th>
            <th>Alumnos</th>
            @if (auth()->user()->rol == 'admin')
                <th>Editar</th>
            @endif
        </x-slot>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->curso_nombre }} </td>
                    <td>{{ $grupo->docente_nombre }}</td>
                    <td>{{ $grupo->horario }}</td>
                    <td>{{ $grupo->anyo }}</td>
                    <td>
                        <a href="{{ route('grupos.show', $grupo->id) }}" class="btn btn-sm btn-primary d-grid">
                            Ver {{ $grupo->inscripciones_count }}
                        </a>
                    </td>

                    @if (auth()->user()->rol == 'admin')
                        <td>
                            <a href="{{ route('grupos.edit', $grupo->id) }}"
                                class="btn btn-sm btn-outline-primary">Editar</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </x-table-head>

@endsection
