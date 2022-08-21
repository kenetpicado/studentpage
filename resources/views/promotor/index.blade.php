@extends('layout')

@section('title', 'Promotores')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Promotores</li>
@endsection

@section('content')
    <x-header-2 text="Promotores">
        <a class="dropdown-item" href="{{ route('promotores.create') }}">Agregar</a>
        <a class="dropdown-item" href="{{ route('permisos.promotores') }}">Permisos</a>
    </x-header-2>

    <x-table-head>
        <x-slot name="title">
            <th>Nombre</th>
            <th>Carnet</th>
            <th>Correo</th>
            <th></th>
        </x-slot>
        <tbody>
            @foreach ($promotors as $promotor)
                <tr>
                    <td>{{ $promotor->nombre }}</td>
                    <td>{{ $promotor->carnet }}</td>
                    <td>{{ $promotor->correo }}</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Opciones <i class="fas fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item" href="{{ route('promotores.show', $promotor->id) }}">Matriculas</a>
                                <a class="dropdown-item" href="{{ route('promotores.edit', $promotor->id) }}">Editar</a>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
