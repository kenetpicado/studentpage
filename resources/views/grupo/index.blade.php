@extends('layout')

@section('title', 'Grupos')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Grupos</li>
@endsection

@section('content')
    @if (auth()->user()->rol == 'admin')
        <x-header-2 text="Todos los Grupos">
            <a class="dropdown-item" href="{{ route('grupos.create') }}">Crear grupo</a>
            <a class="dropdown-item" href="{{ route('grupos.index.closed') }}">Terminados</a>
        </x-header-2>
    @else
        <x-header-0>Todos los Grupos</x-header-0>
    @endif

    <x-table search="search.grupos">
        @slot('title')
            <th>Curso</th>
            <th>Docente</th>
            <th>Horario</th>
            <th>Suc - Año</th>
            <th>Alumnos</th>
            @if (auth()->user()->rol == 'admin')
                <th>Editar</th>
            @endif
        @endslot
        @forelse ($grupos as $grupo)
            <tr>
                <td data-title="Curso">{{ $grupo->curso_nombre }} </td>
                <td data-title="Docente">{{ $grupo->docente_nombre }}</td>
                <td data-title="Horario">{{ $grupo->horario }}</td>
                <td>{{ $grupo->sucursal }} - {{ $grupo->anyo }}</td>
                <td><a class="btn btn-sm btn-primary" href="{{ route('grupos.show', $grupo->id) }}">
                        Alumnos</a>
                </td>
                @if (auth()->user()->rol == 'admin')
                    <td><a class="btn btn-sm btn-outline-primary" href="{{ route('grupos.edit', $grupo->id) }}">Editar</a>
                    </td>
                @endif
            </tr>
            @empty
            <tr>
                <td>No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $grupos->links() !!}
        @endslot
    </x-table>
@endsection
