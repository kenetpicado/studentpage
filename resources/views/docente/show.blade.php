@extends('layout')

@section('title', 'Docente')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Grupos</li>
@endsection

@section('content')
    <x-header-0>Grupos: {{ $docente->nombre }}</x-header-0>
    <x-table>
        @slot('title')
            <th>Curso</th>
            <th>Horario</th>
            <th>Sucursal</th>
            <th>Año</th>
        @endslot
        @foreach ($grupos as $grupo)
            <tr>
                <td data-title="Curso">{{ $grupo->curso_nombre }}</td>
                <td data-title="Horario">{{ $grupo->horario }}</td>
                <td data-title="Cursal">{{ $grupo->sucursal }}</td>
                <td data-title="Año">{{ $grupo->anyo }}</td>
            </tr>
        @endforeach
        @slot('links')
            {!! $grupos->links() !!}
        @endslot
    </x-table>
@endsection
