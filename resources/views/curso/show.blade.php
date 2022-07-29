@extends('layout')

@section('title', 'Cursos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modulos</li>
@endsection

@section('content')
    <x-header-3>Modulos</x-header-3>

    <x-modal-add ruta='modulos.store' title='Modulos'>
        <x-input name="nombre"></x-input>
        <input type="hidden" name="curso_id" value="{{ $curso_id }}">
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
                        <a class="btn btn-primary btn-sm" href="{{ route('modulos.edit', $modulo->id) }}">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
