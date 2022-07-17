@extends('layout')

@section('title', 'Docentes')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Docentes</li>
@endsection

@section('content')
    <x-header-1>Docentes</x-header-1>

    <x-modal-add ruta='docentes.store' title='Docente'>
        <x-input name="nombre"></x-input>
        <x-input name="correo" type="email"></x-input>

        @if (auth()->user()->sucursal == 'all')
            <x-sucursal-form></x-sucursal-form>
        @endif
    </x-modal-add>

    <x-table-head>
        <x-slot name="title">
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Grupos</th>
            <th>Editar</th>
        </x-slot>
        <tbody>
            @foreach ($docentes as $docente)
                <tr>
                    <td>{{ $docente->carnet }}</td>
                    <td>{{ $docente->nombre }}</td>
                    <td>{{ $docente->correo }}</td>
                    <td>
                        @if ($docente->activo > 0)
                            Activo <i class="fas fa-check-circle text-primary"></i>
                        @else
                            Inactivo <i class="fas fa-exclamation-circle text-danger"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('docentes.show', $docente->id) }}" class="btn btn-primary btn-sm">Grupos</a>
                    </td>
                    <td>
                        <a href="{{ route('docentes.edit', $docente->id) }}"
                            class="btn btn-outline-primary btn-sm">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
