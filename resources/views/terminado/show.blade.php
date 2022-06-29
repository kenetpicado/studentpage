@extends('layout')

@section('title', 'Grupo terminado')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.closed') }}">Terminados</a></li>
                <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-0 text="Alumnos"></x-header-0>

                    <x-table-head>
                        <x-slot name="title">
                            <th>Carnet</th>
                            <th>Nombre</th>
                            <th>Notas</th>
                        </x-slot>
                        <tbody>
                            @foreach ($inscripciones as $inscripcion)
                                <tr>
                                    <td>{{ $inscripcion->matricula_carnet }}</td>
                                    <td>{{ $inscripcion->matricula_nombre }}</td>
                                    <td><a href="{{ route('notas.certified', $inscripcion->id) }}" class="btn btn-primary btn-sm">Ver
                                            certicado</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table-head>
                </div>
            </div>
        </div>
    </div>
@endsection
