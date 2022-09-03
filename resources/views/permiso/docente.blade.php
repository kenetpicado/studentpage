@extends('layout')

@section('title', 'Permisos Docentes')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
@endsection

@section('content')
    <x-header-0>Establecer permisos de Docentes</x-header-0>
    <div class="card-body">
        <form action="{{ route('permisos.docente.store') }}" method="post">
            @csrf
            <x-table-head>
                <x-slot name="title">
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th>Permisos</th>
                </x-slot>
                @foreach ($docentes as $key => $docente)
                    <tr>
                        <input type="hidden" name="user_id[{{ $key }}]" value="{{ $docente->id }}">
                        <td>{{ $docente->email }}</td>
                        <td>{{ $docente->name }}</td>
                        <td>
                            <x-switch deny="create_nota" :key="$key" :adm="$docente" label="Agregar Notas"></x-switch>
                            <x-switch deny="edit_nota" :key="$key" :adm="$docente" label="Editar Notas"></x-switch>
                            <x-switch deny="create_mensaje" :key="$key" :adm="$docente" label="Enviar Mensajes"></x-switch>
                        </td>
                    </tr>
                @endforeach
            </x-table-head>
            <div class="mb-3">
                <button type="submit" class="float-end btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </div>
@endsection
