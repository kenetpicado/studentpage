@extends('layout')

@section('title', 'Certificado de Notas')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.closed') }}">Terminados</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.thisClosed', $inscripcion->grupo_id) }}">Alumnos</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Certificado</li>
            </ol>
        </nav>

        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-0 text="Certificado de Notas"></x-header-0>

                    <x-table-head>
                        <x-slot name="title">
                            <th>Materia</th>
                            <th>Nota</th>
                        </x-slot>
                        <tbody>
                            @foreach ($inscripcion->notas as $nota)
                                <tr>
                                    <td>
                                        {{ $nota->num }} - 
                                        {{ $nota->materia }}
                                    </td>
                                    <td>{{ $nota->valor }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table-head>
                </div>
            </form>
        </div>
    </div>
@endsection
