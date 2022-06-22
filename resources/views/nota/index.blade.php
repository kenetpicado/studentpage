@extends('layout')

@section('title', 'Notas')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notas</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-1 modelo="Notas"></x-header-1>

                    {{-- FORM STORE --}}
                    <x-modal-add ruta='notas.store' title='Nota'>
                        <x-input-form label="num" text="Número de materia (Unidad)" type="number"></x-input-form>
                        <x-input-form label="materia"></x-input-form>
                        <x-input-form label="valor" text="Nota"></x-input-form>
                        <input type="hidden" name="inscripcion_id" value="{{ $inscripcion->id }}">
                    </x-modal-add>

                    <x-table-head>
                        <x-slot name="title">
                            <th>Materia</th>
                            <th>Nota</th>
                            <th>Editar</th>
                        </x-slot>
                        <tbody>
                            @foreach ($inscripcion->notas as $nota)
                                <tr>
                                    <td>
                                        {{ $nota->num }} -
                                        {{ $nota->materia }}
                                    </td>
                                    <td>{{ $nota->valor }}</td>
                                    <td>
                                        <a href="{{ route('notas.edit', $nota->id) }}" class="btn btn-sm btn-primary">
                                            Editar
                                        </a>
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
