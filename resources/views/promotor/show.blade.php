@extends('layout')

@section('title', 'Matriculas promotor')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Matrículas</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-0 text='Matrículas'></x-header-0>

                    {{-- INDEX --}}
                    <x-table-head>
                        <x-slot name="title">
                            <th>Carnet</th>
                            <th>Nombre</th>
                            <th>Fecha registro</th>
                            <th>Estado</th>
                            <th>Inscribir</th>
                        </x-slot>
                        <tbody>
                            @foreach ($matriculas as $matricula)
                                <tr>
                                    <td>{{ $matricula->carnet }}</td>
                                    <td>{{ $matricula->nombre }}</td>
                                    <td>{{ $matricula->created_at }}</td>
                                    <td>
                                        <x-status :val="count($matricula->inscripciones)" y="Inscrito" n="Pendiente"></x-status>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('inscripciones.create', [$matricula->id, $matricula->promotor_id]) }}">Inscribir
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
