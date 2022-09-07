@extends('layout')

@section('title', 'Reportes Grupos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('reportes.index') }}">Reportes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Grupos</li>
@endsection

@section('content')
    <x-header-0>Grupos</x-header-0>

    <x-table>
        @slot('title')
            <th>Curso</th>
            <th>Docente</th>
            <th>Horario</th>
            <th>Año</th>
            <th></th>
        @endslot
        @foreach ($grupos as $grupo)
            <tr>
                <td>{{ $grupo->curso_nombre }} </td>
                <td>{{ $grupo->docente_nombre }}</td>
                <td>{{ $grupo->horario }}</td>
                <td>{{ $grupo->anyo }}</td>
                <td>
                    <div class="dropdown">
                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Reportes <i class="fas fa-clipboard-check"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <a class="dropdown-item" href="{{ route('asistencias.show', $grupo->id) }}"
                                target="_blank">Asistencias</a>
                            <a class="dropdown-item" href="{{ route('notas.show', $grupo->id) }}" target="_blank">Notas</a>
                            <a class="dropdown-item" href="{{ route('reportes.pagos', $grupo->id) }}"
                                target="_blank">Pagos</a>
                            <a class="dropdown-item" href="{{ route('reportes.grupo', $grupo->id) }}"
                                target="_blank">General</a>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        @slot('links')
        @endslot
    </x-table>
@endsection
