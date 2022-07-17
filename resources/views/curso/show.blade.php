@extends('layout')

@section('title', 'Cursos')

@section('bread')
<li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
<li class="breadcrumb-item active" aria-current="page">Modulos</li>
@endsection

@section('content')
    <x-header-1>Modulos</x-header-1>

    <x-modal-add ruta='modulos.store' title='Modulos'>
        <x-input name="nombre"></x-input>
    </x-modal-add>

    <x-table-head>
        <x-slot name="title">
            <th>Nombre</th>
            <th>Editar</th>
        </x-slot>
        <tbody>
            @foreach ($modulos as $modulo)
                <tr>
                    <td>{{ $modulo->nombre }}</td>
                    <td>
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('modulos.edit', $modulo->id) }}">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
