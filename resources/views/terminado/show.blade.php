@extends('layout')

@section('title', 'Grupo terminado')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.index.closed') }}">Terminados</a></li>
    <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
@endsection

@section('content')
    <x-header-0>Alumnos</x-header-0>

    <x-table-head>
        <x-slot name="title">
            <th>Carnet</th>
            <th>Nombre</th>
            <th>Notas</th>
        </x-slot>
        <tbody>
            @foreach ($inscripciones as $inscripcion)
                <tr>
                    <td>{{ $inscripcion->matricula_carnet }}</td>
                    <td>{{ $inscripcion->matricula_nombre }}</td>
                    <td><a href="{{ route('notas.certified', $inscripcion->id) }}" class="btn btn-primary btn-sm">Ver
                            certicado</a></td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
