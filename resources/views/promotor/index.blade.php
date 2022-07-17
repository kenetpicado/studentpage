@extends('layout')

@section('title', 'Promotores')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Promotores</li>
@endsection

@section('content')
    <x-header-1>Promotores</x-header-1>
    <x-modal-add ruta='promotores.store' title='Promotor'>
        <x-input name="nombre"></x-input>
        <x-input name="correo" type="email"></x-input>
    </x-modal-add>

    <x-table-head>
        <x-slot name="title">
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Matriculas</th>
            <th>Editar</th>
        </x-slot>
        <tbody>
            @foreach ($promotors as $promotor)
                <tr>
                    <td>{{ $promotor->carnet }}</td>
                    <td>{{ $promotor->nombre }}</td>
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
