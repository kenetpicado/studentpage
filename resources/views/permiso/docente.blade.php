@extends('layout')

@section('title', 'Permisos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
@endsection

@section('content')
    <x-header-0>Permisos</x-header-0>
    <p class="card-body">
        Permitir o negar el acceso para registrar notas y enviar mensajes.
    </p>
    <x-create-form ruta="permisos.docente.store">
        <table class="table table-borderless">
            <thead>
                <tr class="text-uppercase small text-primary">
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th class="text-center">Registrar notas</th>
                    <th class="text-center">Enviar mensajes</th>
                </tr>
            </thead>
            @foreach ($docentes as $key => $docente)
                <tr>
                    <input type="hidden" name="user_id[{{ $key }}]" value="{{ $docente->id }}">
                    <td>{{ $docente->email }}</td>
                    <td>{{ $docente->name }}</td>
                    <td class="text-center">
                        <input type="hidden" name="permitir_nota[{{ $key }}]" value="0">

                        @if ($docente->permisos->contains('denegar', 'create_nota'))
                            <div class="form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    name="permitir_nota[{{ $key }}]" value="1">
                            </div>
                        @else
                            <div class="form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    name="permitir_nota[{{ $key }}]" value="1" checked>
                            </div>
                        @endif
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="permitir_mensaje[{{ $key }}]" value="0">

                        @if ($docente->permisos->contains('denegar', 'create_mensaje'))
                            <div class="form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    name="permitir_mensaje[{{ $key }}]" value="1">
                            </div>
                        @else
                            <div class="form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    name="permitir_mensaje[{{ $key }}]" value="1" checked>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </x-create-form>
@endsection
