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
                <th>Opciones</th>
            @endif
        </x-slot>
        <tbody>
            @foreach ($inscripciones as $inscripcion)
                <tr>
                    <td>
                        @if ($inscripcion->activo == 1)
                            <i class="fas fa-circle fa-sm text-primary"></i>
                        @else
                            <i class="fas fa-circle fa-sm text-danger"></i>
                        @endif
                        {{ $inscripcion->matricula_carnet }}
                    </td>
                    <td>{{ $inscripcion->matricula_nombre }}</td>
                    <td>
                        <a href="{{ route('notas.index', $inscripcion->id) }}" class="btn btn-sm btn-primary">Notas</a>
                    </td>
                    @if (auth()->user()->rol == 'admin')
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opciones
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a href="{{ route('inscripciones.edit', $inscripcion->id) }}"
                                            class="dropdown-item">Mover</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('cambiar.estado', $inscripcion->matricula_id) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="dropdown-item">Cambiar estado</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
