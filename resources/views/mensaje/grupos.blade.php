@extends('layout')

@section('title', 'Mensajes')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Notificaciones</li>
@endsection

@section('content')
    <x-header-1 ruta="mensajes.agregar">Notificaciones</x-header-1>

    <x-table-head>
        <x-slot name="title">
            <th>Contenido</th>
            <th width="10%">Editar</th>
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
                        <a href="{{ route('mensajes.modificar', $mensaje->id) }}" class="btn btn-sm btn-primary">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
