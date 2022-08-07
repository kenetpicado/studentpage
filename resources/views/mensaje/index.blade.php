@extends('layout')

@section('title', 'Mensajes')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Mensajes</li>
@endsection

@section('content')
    <x-header-3>Mensajes</x-header-1>

        <x-modal-add ruta='mensajes.store' title='Mensaje'>
            <div class="mb-3">
                <label class="form-label">Contenido</label>
                <textarea name="contenido" rows="5" class="form-control @error('contenido') is-invalid @enderror"></textarea>

                @error('contenido')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <x-input name="enlace" label="Enlace - (Opcional)"></x-input>
            <input type="hidden" name="grupo_id" value="{{ $grupo_id }}">
        </x-modal-add>

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
                            @if ($mensaje->grupo_id)
                                <a href="{{ route('mensajes.edit', $mensaje->id) }}"
                                    class="btn btn-sm btn-primary">Editar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table-head>
    @endsection
