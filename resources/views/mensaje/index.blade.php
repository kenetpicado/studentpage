@extends('layout')

@section('title', 'Mensajes')

@section('bread')
    @if ($grupo_id)
        <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('grupos.show', $grupo_id) }}">Alumnos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mensajes</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">Mensajes</li>
    @endif
@endsection

@section('content')
    <div class="card-header d-flex align-items-center justify-content-between">
        Todos los Mensajes del Grupo
        <a href="{{ route('mensajes.create', [$type, $grupo_id]) }}" class="btn btn-sm btn-primary rounded-3 float-end">
            Agregar
        </a>
    </div>

    <x-table-head>
        <x-slot name="title">
            <th></th>
            <th width="10%"></th>
        </x-slot>
        <tbody>
            @foreach ($mensajes as $mensaje)
                <tr>
                    <td>
                        <div style="border-radius: 25px" class="p-3 bg-secondary bg-opacity-10">
                            <div class="small text-primary">
                                {{ date('d F Y', strtotime($mensaje->created_at)) }} -
                                {{ $mensaje->from }}:
                            </div>
                            {{ $mensaje->contenido }}
                            @if ($mensaje->enlace)
                                <a href={{ $mensaje->enlace }} target="_blank">Ir al enlace</a>
                            @endif
                        </div>
                    </td>
                    <td style="vertical-align:middle;">
                        @if ($type == 'global')
                            <a href="{{ route('mensajes.edit', [$mensaje->id, $type]) }}"
                                class="btn btn-sm btn-primary">Editar</a>
                        @else
                            @if ($mensaje->grupo_id)
                                <a href="{{ route('mensajes.edit', [$mensaje->id, $type]) }}"
                                    class="btn btn-sm btn-primary">Editar</a>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
