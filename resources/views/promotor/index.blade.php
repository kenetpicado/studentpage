@extends('layout')

@section('title', 'Promotores')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Promotores</li>
@endsection

@section('content')
    <x-header-2 text="Todos los Promotores">
        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCreate">Agregar</a>
        <a class="dropdown-item" href="{{ route('permisos.promotores') }}">Permisos</a>
    </x-header-2>

    <x-modal title="Promotor - Agregar">
        <form action="{{ route('promotores.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <x-input name="nombre"></x-input>
                <x-input name="correo" type="email"></x-input>
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
            <th>Matriculas</th>
            <th>Editar</th>
        </x-slot>
        <tbody>
            @foreach ($promotors as $promotor)
                <tr>
                    <td>{{ $promotor->nombre }}</td>
                    <td>{{ $promotor->carnet }}</td>
                    <td>{{ $promotor->correo }}</td>
                    <td><a class="btn btn-sm btn-primary" href="{{ route('promotores.show', $promotor->id) }}">Matriculas</a></td>
                    <td><a class="btn btn-sm btn-outline-primary" href="{{ route('promotores.edit', $promotor->id) }}">Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
