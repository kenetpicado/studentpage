@extends('layout')

@section('title', 'Certificado de Notas')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.index.closed') }}">Terminados</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show.closed', $inscripcion->grupo_id) }}">Alumnos</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Certificado</li>
@endsection

@section('content')
    <x-header-0>Certificado de Notas</x-header-0>
    <x-main>
        <table class="table table-borderless">
            <tr>
                <th>Modulo</th>
                <th>Nota</th>
            </tr>
            <tbody>
                @foreach ($notas as $nota)
                        <td>{{ $nota->modulo }}</td>
                        <td>{{ $nota->valor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-main>
@endsection
