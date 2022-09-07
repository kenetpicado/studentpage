@extends('layout')

@section('title', 'Notas')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Notas</li>
@endsection

@section('content')
    <x-header-0>Notas</x-header-0>
    <x-main>
        <p>
            Notas del Curso
        </p>
        <h5 class="fw-bolder">{{$grupo->nombre}} {{$grupo->horario}}</h5>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Modulo</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notas as $nota)
                    <tr>
                        <td>{{ $nota->modulo }}</td>
                        <td>{{ $nota->valor }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>No hay registros</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-main>
@endsection
