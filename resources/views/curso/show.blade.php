@extends('layout')

@section('title', 'Cursos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modulos</li>
@endsection

@section('content')
    <x-header-1 ruta="modulos.create" :id="$curso_id">Modulos</x-header-1>

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
