@extends('layout')

@section('title', 'Cursos')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Cursos</li>
@endsection

@section('content')
    <div class="card-header d-flex align-items-center justify-content-between border-0">
        Todos los Cursos
        <button type="button" class="btn btn-sm btn-primary rounded-3 float-end" data-bs-toggle="modal"
            data-bs-target="#modalCreate">
            Agregar
        </button>
    </div>
    <x-modal title="Curso - Agregar">
        <form action="{{ route('cursos.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <x-input name="nombre"></x-input>
                <x-imagenes :imagenes="$imagenes"></x-imagenes>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </x-modal>

    <x-table-head>
        <x-slot name="title">
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Estado</th>
            <th>Modulos</th>
            <th>Editar</th>
        </x-slot>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td>{{ $curso->nombre }}</td>
                    <td>{{ $curso->imagen }}</td>
                    <td>{{ $curso->activo == '1' ? 'Activo' : '-' }}</td>
                    <td><a class="btn btn-sm btn-primary" href="{{ route('cursos.show', $curso->id) }}">Modulos</a></td>
                    <td><a class="btn btn-sm btn-outline-primary" href="{{ route('cursos.edit', $curso->id) }}">Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
