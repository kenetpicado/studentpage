@extends('layout')

@section('title', 'Grupos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('reportes.index') }}">Reportes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Notas</li>
@endsection

@section('content')
    <x-header-0>Grupos</x-header-0>

    <x-table-head>
        <x-slot name="title">
            <th>Curso</th>
            <th>Docente</th>
            <th>Horario</th>
            <th>Año</th>
            <th>Reporte</th>
        </x-slot>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->curso_nombre }} </td>
                    <td>{{ $grupo->docente_nombre }}</td>
                    <td>{{ $grupo->horario }}</td>
                    <td>{{ $grupo->anyo }}</td>
                    <td>
                        @if ($grupo->inscripciones_count)
                            <a href="{{ route('notas.show', $grupo->id) }}" class="btn btn-sm btn-primary" target="_blank">
                                Reporte de notas</a>
                        @else
                            Vacío
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>

@endsection
