@extends('layout')

@section('title', 'Grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
@endsection

@section('content')
    <x-header-2 text="Alumnos">
        <a href="{{ route('asistencias.index', $grupo_id) }}" class="dropdown-item">
            Asistencia
        </a>
        <a href="{{ route('mensajes.index', ['grupo', $grupo_id]) }}" class="dropdown-item">
            Mensajes
        </a>
        @if (count($inscripciones))
            <a href="{{ route('asistencias.show', $grupo_id) }}" class="dropdown-item" target="_blank">
                Reporte asistencia
            </a>

            <a href="{{ route('notas.show', $grupo_id) }}" class="dropdown-item" target="_blank">
                Reporte de notas</a>
            @if (auth()->user()->rol == 'admin')
                <a href="{{ route('reportes.grupo', $grupo_id) }}" class="dropdown-item" target="_blank">
                    Reporte de grupo</a>
            @endif
        @endif
    </x-header-2>

    <x-table-head>
        <x-slot name="title">
            <th>Nombre</th>
            <th>Carnet</th>
            <th></th>
        </x-slot>
        <tbody>
            @foreach ($inscripciones as $inscripcion)
                <tr>
                    <td>{{ $inscripcion->matricula_nombre }}</td>
                    <td>{{ $inscripcion->matricula_carnet }}</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Opciones <i class="fas fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item" href="{{ route('notas.index', $inscripcion->id) }}"
                                    class="btn btn-sm btn-primary">Notas</a>

                                @if (auth()->user()->rol == 'admin')
                                    <a href="{{ route('inscripciones.edit', $inscripcion->id) }}"
                                        class="dropdown-item">Editar</a>

                                    <form action="{{ route('cambiar.estado', $inscripcion->matricula_id) }}"
                                        method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item">Desactivar</button>
                                    </form>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
