@extends('layout')

@section('title', 'Grupos terminados')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Terminados</li>
@endsection

@section('content')
    <x-header-0>Terminados</x-header-0>

    <x-table-head>
        <x-slot name="title">
            <th>Curso</th>
            <th>Docente</th>
            <th>Horario</th>
            <th>Año</th>
            <th>Sucursal</th>
            <th>Alumnos</th>
            <th>Opción</th>
        </x-slot>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->curso_nombre }}</td>
                    <td>{{ $grupo->docente_nombre }}</td>
                    <td>{{ $grupo->horario }}</td>
                    <td>{{ $grupo->anyo }}</td>
                    <td>{{ $grupo->sucursal }}</td>
                    <td>
                        <a href="{{ route('grupos.thisClosed', $grupo->id) }}" class="btn btn-primary btn-sm d-grid">
                            Ver
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('cambiar.estado.grupo', $grupo->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-outline-primary btn-sm">Reactivar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
