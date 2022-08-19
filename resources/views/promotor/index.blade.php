@extends('layout')

@section('title', 'Promotores')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Promotores</li>
@endsection

@section('content')
    <x-header-1 ruta="promotores.create">Promotores</x-header-1>

    <x-table-head>
        <x-slot name="title">
            <th>Nombre</th>
            <th>Canet</th>
            <th>Correo</th>
            <th>Matriculas</th>
            <th>Editar</th>
        </x-slot>
        <tbody>
            @foreach ($promotors as $promotor)
                <tr>
                    <td>{{ $promotor->nombre }}</td>
                    <td>{{ $promotor->carnet }}</td>
                    <td>{{ $promotor->correo }}</td>
                    <td>
                        <a href="{{ route('promotores.show', $promotor->id) }}"
                            class="btn btn-primary btn-sm">Matriculas</a>
                    </td>
                    <td>
                        <a href="{{ route('promotores.edit', $promotor->id) }}"
                            class="btn btn-outline-primary btn-sm">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
