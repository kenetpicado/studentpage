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
    </div>

    <x-table-head>
        <x-slot name="title">
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Estado</th>
            <th></th>
        </x-slot>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td>{{ $curso->nombre }}</td>
                    <td>{{ $curso->imagen }}</td>
                    <td>{{ $curso->activo == '1' ? 'Activo' : '-' }}</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Opciones <i class="fas fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item" href="{{ route('cursos.show', $curso->id) }}">Modulos</a>
                                <a class="dropdown-item" href="{{ route('cursos.edit', $curso->id) }}">Editar</a>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
