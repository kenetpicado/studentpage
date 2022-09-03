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
                    <th>Sucursal</th>
                    <th>Permisos</th>
                </x-slot>
                <tbody>
                    @foreach ($adms as $key => $adm)
                        <tr>
                            <td>{{ $adm->email }}</td>
                            <td>{{ $adm->name }}</td>
                            <td>{{ $adm->sucursal == 'CH' ? 'Chinandega' : 'Managua' }}</td>
                            <td>
                                <x-switch deny="create_promotor" :key="$key" :adm="$adm"
                                    label="Crear nuevo Promotor"></x-switch>
                                <x-switch deny="create_docente" :key="$key" :adm="$adm"
                                    label="Crear nuevo Docente"></x-switch>
                                <x-switch deny="create_curso" :key="$key" :adm="$adm" label="Crear nuevo Curso">
                                </x-switch>
                                <x-switch deny="create_grupo" :key="$key" :adm="$adm" label="Crear nuevo Grupo">
                                </x-switch>
                                <x-switch deny="create_matricula" :key="$key" :adm="$adm"
                                    label="Crear nueva Matricula"></x-switch>
                                <x-switch deny="create_mensaje" :key="$key" :adm="$adm"
                                    label="Enviar Mensajes"></x-switch>
                                <x-switch deny="create_nota" :key="$key" :adm="$adm" label="Agregar Notas">
                                </x-switch>
                                <x-switch deny="edit_nota" :key="$key" :adm="$adm" label="Editar Nota">
                                </x-switch>
                                <input type="hidden" name="user_id[{{ $key }}]" value="{{ $adm->id }}">
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
