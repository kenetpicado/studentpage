@extends('layout')

@section('title', 'Docente')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Grupos</li>
@endsection

@section('content')
    <x-header-1>Grupos</x-header-1>

    <x-table-head>
        <x-slot name="title">
            <th>Curso</th>
            <th>Horario</th>
            <th>Sucursal</th>
            <th>Año</th>
        </x-slot>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->curso_nombre }}</td>
                    <td>{{ $grupo->horario }}</td>
                    <td>{{ $grupo->sucursal }}</td>
                    <td>{{ $grupo->anyo }}</td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
