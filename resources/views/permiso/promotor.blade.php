@extends('layout')

@section('title', 'Permisos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
@endsection

@section('content')
    <x-header-0>Permisos</x-header-0>
    <div class="card-body">
        <p>Permitir o negar el acceso para crear nuevas matriculas.</p>
        <form action="{{ route('permisos.promotor.store') }}" method="post">
            @csrf
            <x-table-head>
                <x-slot name="title">
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th class="text-center">Matricular</th>
                </x-slot>
                @foreach ($promotores as $key => $promotor)
                    <tr>
                        <input type="hidden" name="user_id[{{ $key }}]" value="{{ $promotor->id }}">
                        <td>{{ $promotor->email }}</td>
                        <td>{{ $promotor->name }}</td>
                        <x-switch name="matricula" :key="$key" :adm="$promotor"></x-switch>
                    </tr>
                @endforeach
            </x-table-head>
            <div class="mb-3">
                <button type="submit" class="float-end btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </div>
@endsection
