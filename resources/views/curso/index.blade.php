@extends('layout')

@section('title', 'Cursos')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Cursos</li>
@endsection

@section('content')
    <x-header-1>Cursos</x-header-1>

    <x-modal-add ruta='cursos.store' title='Cursos'>
        <x-input name="nombre"></x-input>
        <x-imagenes :imagenes="$imagenes"></x-imagenes>
    </x-modal-add>

    <x-table-head>
        <x-slot name="title">
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Estado</th>
            <th>Editar</th>
        </x-slot>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td>{{ $curso->nombre }}</td>
                    <td>{{ $curso->imagen }}</td>
                    <td>
                        @if ($curso->activo > 0)
                            Activo <i class="fas fa-check-circle text-primary"></i>
                        @else
                            Inactivo <i class="fas fa-exclamation-circle text-danger"></i>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('cursos.edit', $curso->id) }}">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
