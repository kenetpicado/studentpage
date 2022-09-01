@extends('layout')

@section('title', 'Permisos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
@endsection

@section('content')
    <x-header-0>Permisos</x-header-0>
    <div class="card-body">
        <p>Permitir o negar el acceso para registrar notas y enviar mensajes.</p>

        <form action="{{ route('permisos.docente.store') }}" method="post">
            @csrf
            <x-table-head>
                <x-slot name="title">
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th class="text-center">Registrar notas</th>
                    <th class="text-center">Enviar mensajes</th>
                </x-slot>
                @foreach ($docentes as $key => $docente)
                    <tr>
                        <input type="hidden" name="user_id[{{ $key }}]" value="{{ $docente->id }}">
                        <td>{{ $docente->email }}</td>
                        <td>{{ $docente->name }}</td>
                        <x-switch name="nota" :key="$key" :adm="$docente"></x-switch>
                        <x-switch name="mensaje" :key="$key" :adm="$docente"></x-switch>
                    </tr>
                @endforeach
            </x-table-head>
            <div class="mb-3">
                <button type="submit" class="float-end btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </div>
@endsection
