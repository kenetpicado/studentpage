@extends('layout')

@section('title', 'Permisos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
@endsection

@section('content')
    <x-header-0>Permisos</x-header-0>
    <p class="card-body">
        Permitir o negar el acceso para crear nuevas matriculas.
    </p>
    <x-create-form ruta="permisos.promotor.store">

        <table class="table table-borderless">
            <thead>
                <tr class="text-uppercase small text-primary">
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th class="text-center">Matricular</th>
                </tr>
            </thead>
            @foreach ($promotores as $key => $promotor)
                <tr>
                    <input type="hidden" name="user_id[{{ $key }}]" value="{{ $promotor->id }}">
                    <td>{{ $promotor->email }}</td>
                    <td>{{ $promotor->name }}</td>
                    <x-switch name="matricula" :key="$key" :adm="$promotor"></x-switch>
                </tr>
            @endforeach
        </table>
    </x-create-form>
@endsection
