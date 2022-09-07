@extends('layout')

@section('title', 'Permisos Docentes')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
@endsection

@section('content')
    <x-header-0>Permisos: Docentes</x-header-0>
    
    <div class="card-body">
        <p>
            Permitir o negar el acceso a crear / editar notas y crear nuevos mensajes a un determinado Docente.
        </p>
        <form action="{{ route('permisos.docente.store') }}" method="post">
            @csrf
            <table class="table table-borderless" id="no-more-tables" width="100%">
                <thead>
                    <tr>
                        <th>Carnet</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docentes as $key => $docente)
                        <tr>
                            <input type="hidden" name="user_id[{{ $key }}]" value="{{ $docente->id }}">
                            <td data-title="Carnet">{{ $docente->email }}</td>
                            <td  data-title="Nombre">{{ $docente->name }}</td>
                            <td>
                                <x-switch deny="create_nota" :key="$key" :adm="$docente" label="Agregar Notas">
                                </x-switch>
                                <x-switch deny="edit_nota" :key="$key" :adm="$docente" label="Editar Notas">
                                </x-switch>
                                <x-switch deny="create_mensaje" :key="$key" :adm="$docente" label="Enviar Mensajes">
                                </x-switch>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mb-3">
                <button type="submit" class="float-end btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </div>
@endsection
