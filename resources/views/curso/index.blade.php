@extends('layout')

@section('title', 'Cursos')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cursos</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-1 modelo='Cursos'></x-header-1>

                    {{-- FORM STORE --}}
                    <x-modal-add ruta='cursos.store' title='Cursos'>
                        <x-input-form label="nombre"></x-input-form>
                    </x-modal-add>

                    {{-- INDEX --}}
                    <x-table-head>
                        <x-slot name="title">
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Editar</th>
                        </x-slot>
                        <tbody>
                            @foreach ($cursos as $curso)
                                <tr>
                                    <td>{{ $curso->nombre }}</td>
                                    <td>
                                        <x-status :val="$curso->activo"></x-status>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('cursos.edit', $curso->id) }}">
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
