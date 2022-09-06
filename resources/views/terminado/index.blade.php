@extends('layout')

@section('title', 'Grupos terminados')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Terminados</li>
@endsection

@section('content')
    <x-header-0>Todos los Grupos terminados</x-header-0>

    <x-table>
        @slot('title')
            <th>Curso</th>
            <th>Docente</th>
            <th>Horario</th>
            <th>Año</th>
            <th>Sucursal</th>
            <th>Alumnos</th>
            <th>Activar</th>
        @endslot
        @foreach ($grupos as $grupo)
            <tr>
                <td>{{ $grupo->curso_nombre }}</td>
                <td>{{ $grupo->docente_nombre }}</td>
                <td>{{ $grupo->horario }}</td>
                <td>{{ $grupo->anyo }}</td>
                <td>{{ $grupo->sucursal }}</td>
                <td>
                    <a href="{{ route('grupos.show.closed', $grupo->id) }}" class="btn btn-primary btn-sm d-grid">
                        Alumnos
                    </a>
                </td>
                <td>
                    <form action="{{ route('cambiar.estado.grupo', $grupo->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-outline-primary btn-sm">Activar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        @slot('links')
        @endslot
    </x-table>
@endsection
