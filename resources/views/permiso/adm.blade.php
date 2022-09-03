@extends('layout')

@section('title', 'Permisos')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Administradores</li>
@endsection

@section('content')
    <x-header-0>Establecer permisos de Administradores</x-header-0>
    <div class="card-body">
        <form action="{{ route('permisos.adm.store') }}" method="post">
            @csrf
            <x-table-head>
                <x-slot name="title">
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th class="text-center">Crear Promotor</th>
                    <th class="text-center">Crear Docente</th>
                    <th class="text-center">Crear Curso</th>
                    <th class="text-center">Crear Grupo</th>
                    <th class="text-center">Crear Matrícula</th>
                    <th class="text-center">Crear Mensaje</th>
                </x-slot>
                @foreach ($adms as $key => $adm)
                    <tr>
                        <input type="hidden" name="user_id[{{ $key }}]" value="{{ $adm->id }}">
                        <td>{{ $adm->email }}</td>
                        <td>{{ $adm->name }}</td>
                        <x-switch name="promotor" :key="$key" :adm="$adm"></x-switch>
                        <x-switch name="docente" :key="$key" :adm="$adm"></x-switch>
                        <x-switch name="curso" :key="$key" :adm="$adm"></x-switch>
                        <x-switch name="grupo" :key="$key" :adm="$adm"></x-switch>
                        <x-switch name="matricula" :key="$key" :adm="$adm"></x-switch>
                        <x-switch name="mensaje" :key="$key" :adm="$adm"></x-switch>
                    </tr>
                @endforeach
            </x-table-head>
            <div class="mb-3">
                <button type="submit" class="float-end btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </div>
@endsection
