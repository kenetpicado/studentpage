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
                    <x-select name="sucursal" :items="$sucursales"></x-select>
                @endif
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </x-modal>

    <x-table>
        @slot('title')
            <th>Nombre</th>
            <th>Carnet</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Grupos</th>
            <th>Editar</th>
        @endslot
        @foreach ($docentes as $docente)
            <tr>
                <td data-title="Nombre">{{ $docente->nombre }}</td>
                <td data-title="Carnet">{{ $docente->carnet }}</td>
                <td data-title="Correo">{{ $docente->correo }}</td>
                <td data-title="Estado">{{ $docente->activo == '1' ? 'Activo' : '-' }}</td>
                <td><a class="btn btn-sm btn-primary" href="{{ route('docentes.show', $docente->id) }}">Grupos</a></td>
                <td><a class="btn btn-sm btn-outline-primary" href="{{ route('docentes.edit', $docente->id) }}">Editar</a>
                </td>
            </tr>
        @endforeach
        @slot('links')
            {!! $docentes->links() !!}
        @endslot
        </x-table>
    @endsection
