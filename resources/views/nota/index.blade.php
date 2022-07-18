@extends('layout')

@section('title', 'Notas')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Notas</li>
@endsection

@section('content')
    <x-header-1>Notas</x-header-1>

    <x-modal-add ruta='notas.store' title='Nota'>
        <x-select-0 name="modulo_id" :items="$modulos" text="Modulo"></x-select-0>
        <x-input name="valor" label="Nota"></x-input>
        <input type="hidden" name="inscripcion_id" value="{{ $inscripcion->id }}">
    </x-modal-add>

    <x-table-head>
        <x-slot name="title">
            <th>Modulo</th>
            <th>Nota</th>
            <th>Fecha de registro</th>
            <th>Editar</th>
        </x-slot>
        <tbody>
            @foreach ($notas as $nota)
                <tr>
                    <td>{{ $nota->modulo_nombre }}</td>
                    <td>{{ $nota->valor }}</td>
                    <td>Fecha</td>
                    <td>
                        <a href="{{ route('notas.edit', $nota->id) }}" class="btn btn-sm btn-primary">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
