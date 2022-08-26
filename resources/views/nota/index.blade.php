@extends('layout')

@section('title', 'Notas')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Notas</li>
@endsection

@section('content')
    <x-header-1 ruta="notas.create" :id="$inscripcion->id">Notas</x-header-1>

    <x-table-head>
        <x-slot name="title">
            <th>Modulo</th>
            <th>Nota</th>
            <th>Registro</th>
            <th></th>
        </x-slot>
        <tbody>
            @foreach ($notas as $nota)
                <tr>
                    <td>{{ $nota->modulo }}</td>
                    <td>{{ $nota->valor }}</td>
                    <td>{{ $nota->created_at }}</td>
                    <td>
                        <a href="{{ route('notas.edit', $nota->id) }}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
