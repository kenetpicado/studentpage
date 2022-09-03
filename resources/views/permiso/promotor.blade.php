@extends('layout')

@section('title', 'Permisos Promotores')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
@endsection

@section('content')
    <x-header-0>Establecer permisos de Promotores</x-header-0>
    <div class="card-body">
        <form action="{{ route('permisos.promotor.store') }}" method="post">
            @csrf
            <x-table-head>
                <x-slot name="title">
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th>Permisos</th>
                </x-slot>
                @foreach ($promotores as $key => $promotor)
                    <tr>
                        <input type="hidden" name="user_id[{{ $key }}]" value="{{ $promotor->id }}">
                        <td>{{ $promotor->email }}</td>
                        <td>{{ $promotor->name }}</td>
                        <td>
                            <x-switch deny="create_matricula" :key="$key" :adm="$promotor"
                                label="Crear nueva Matricula"></x-switch>
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
