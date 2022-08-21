@extends('layout')

@section('title', 'Docentes')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Docentes</li>
@endsection

@section('content')
    <x-header-1 ruta="docentes.create">Docentes</x-header-1>
    <x-table-head>
        <a href="">Configurar permisos</a>
        <x-slot name="title">
            <th>Nombre</th>
            <th>Carnet</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Sucursal</th>
            <th></th>
        </x-slot>
        <tbody>
            @foreach ($docentes as $docente)
                <tr>
                    <td>{{ $docente->nombre }}</td>
                    <td>{{ $docente->carnet }}</td>
                    <td>{{ $docente->correo }}</td>
                    <td>{{ $docente->activo == '1' ? 'Activo' : '-' }}</td>
                    <td>{{ $docente->sucursal }}</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Opciones <i class="fas fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item" href="{{ route('docentes.show', $docente->id) }}">Grupos</a>
                                <a class="dropdown-item" href="{{ route('docentes.edit', $docente->id) }}">Editar</a>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
