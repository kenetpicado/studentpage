@extends('layout')

@section('title', 'Certificado de Notas')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.closed') }}">Terminados</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.thisClosed', $inscripcion->grupo_id) }}">Alumnos</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Certificado</li>
@endsection

@section('content')
    <x-header-0>Certificado de Notas</x-header-0>
    <x-table-head>
        <x-slot name="title">
            <th>Fecha de registro</th>
            <th>Modulo</th>
            <th>Nota</th>
        </x-slot>
        <tbody>
            @foreach ($notas as $nota)
                <tr>
                    <td>{{ $nota->created_at }}</td>
                    <td>
                        {{ $nota->modulo }}
                    </td>
                    <td>{{ $nota->valor }}</td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
