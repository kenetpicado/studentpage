@extends('layout')

@section('title', 'Grupos')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Grupos</li>
@endsection

@section('content')
    @if (auth()->user()->rol == 'admin')
        <x-header-2 text="Grupos">
            <a class="dropdown-item" href="{{ route('grupos.create') }}">Crear grupo</a>
            <a class="dropdown-item" href="{{ route('grupos.index.closed') }}">Grupos terminados</a>
        </x-header-2>
    @else
        <x-header-0>Grupos</x-header-0>
    @endif

    <x-table-head>
        <x-slot name="title">
            <th>Curso</th>
            <th>Docente</th>
            <th>Horario</th>
            <th>Suc - Año</th>
            <th></th>
        </x-slot>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->curso_nombre }} </td>
                    <td>{{ $grupo->docente_nombre }}</td>
                    <td>{{ $grupo->horario }}</td>
                    <td>{{ $grupo->sucursal }} - {{ $grupo->anyo }}</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Opciones <i class="fas fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item" href="{{ route('grupos.show', $grupo->id) }}">
                                    Alumnos
                                </a>
                                @if (auth()->user()->rol == 'admin')
                                    <a class="dropdown-item" href="{{ route('grupos.edit', $grupo->id) }}">Editar</a>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>

@endsection
