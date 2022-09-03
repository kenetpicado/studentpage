@extends('layout')

@section('title', 'Docentes')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Docentes</li>
@endsection

@section('content')
    <x-header-2 text="Todos los Docentes">
        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCreate">Agregar</a>
        <a class="dropdown-item" href="{{ route('permisos.docentes') }}">Permisos</a>
    </x-header-2>

    <x-modal title="Docente - Agregar">
        <form action="{{ route('docentes.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <x-input name="nombre"></x-input>
                <x-input name="correo" type="email"></x-input>

                @if (auth()->user()->sucursal == 'all')
                    <x-sucursal-form></x-sucursal-form>
                @endif
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </x-modal>

    <x-table-head>
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
