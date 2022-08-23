@extends('layout')

@section('title', 'Permisos')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Administradores</li>
@endsection

@section('content')
    <x-header-0>Permisos</x-header-0>
    <p class="card-body">
        Permitir o negar el acceso a los administradores locales.
    </p>
    <form action="{{ route('permisos.adm.store') }}" method="post" class="card-body">
        @csrf
        <table class="table table-borderless align-middle display responsive nowrap" id="dataTable">
            <thead>
                <tr class="text-uppercase small text-primary">
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th class="text-center">Crear Promotor</th>
                    <th class="text-center">Crear Docente</th>
                    <th class="text-center">Crear Curso</th>
                    <th class="text-center">Crear Grupo</th>
                    <th class="text-center">Crear Matrícula</th>
                    <th class="text-center">Crear Mensaje</th>
                </tr>
            </thead>
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
        </table>
        <div class="mb-3">
            <button type="submit" class="float-end btn btn-primary rounded-3">Guardar</button>
        </div>
    </form>
@endsection
