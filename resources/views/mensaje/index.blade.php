@extends('layout')

@section('title', 'Mensajes')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mensajes</li>
            </ol>
        </nav>
        <x-message></x-message>
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-1 modelo='Mensajes'></x-header-1>

                    {{-- FORM STORE --}}
                    <x-modal-add ruta='mensajes.store' title='Mensaje'>
                        <div class="form-group">
                            <label>Contenido</label>
                            <textarea name="contenido" rows="5" class="form-control @error('contenido') is-invalid @enderror"></textarea>

                            @error('contenido')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="grupo_id" value="{{ $grupo_id }}">
                    </x-modal-add>

                    {{-- INDEX --}}
                    <x-table-head>
                        <x-slot name="title">
                            <th>Contenido</th>
                            <th width="10%">Editar</th>
                        </x-slot>
                        <tbody>
                            @foreach ($mensajes as $mensaje)
                                <tr>
                                    <td>
                                        <div style="border: 1px; border-radius: 25px" class="p-3 bg-gray-200 shadow-md">
                                            <div class="small text-primary">
                                                {{ date('d F Y', strtotime($mensaje->created_at)) }} -
                                                {{ $mensaje->from }}:
                                            </div>
                                            {{ $mensaje->contenido }}
                                        </div>
                                    </td>
                                    <td style="vertical-align:middle;">
                                        <a href="{{ route('mensajes.edit', $mensaje->id) }}"
                                            class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table-head>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-open-modal></x-open-modal>
