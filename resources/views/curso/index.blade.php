@extends('layout')

@section('title', 'Cursos')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Cursos</li>
@endsection

@section('content')
    <x-header-modal>Todos los Cursos</x-header-modal>

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
    <x-table>
        @slot('title')
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Estado</th>
            <th>Modulos</th>
            <th>Editar</th>
        @endslot
        @foreach ($cursos as $curso)
            <tr>
                <td>{{ $curso->nombre }}</td>
                <td>{{ $curso->imagen }}</td>
                <td>{{ $curso->activo == '1' ? 'Activo' : '-' }}</td>
                <td><a class="btn btn-sm btn-primary" href="{{ route('cursos.show', $curso->id) }}">Modulos</a></td>
                <td><a class="btn btn-sm btn-outline-primary" href="{{ route('cursos.edit', $curso->id) }}">Editar</a></td>
            </tr>
        @endforeach
        @slot('links')
            {!! $cursos->links() !!}
        @endslot
    </x-table>
@endsection
