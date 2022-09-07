@extends('layout')

@section('title', 'Reportes')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Reportes</li>
@endsection

@section('content')
    <x-header-0>Reportes</x-header-0>

    <x-main>
        <ul>
            <li><a href="{{ route('reportes.promotores') }}">Promotores</a></li>
            <li><a href="{{ route('reportes.grupos') }}">Grupos</a></li>
        </ul>
        <hr>
        <p>
            Generar reporte de todas las Matrículas en un rango de fechas determinado por el administrador.
            Por favor, ingrese la fecha de inicio y fin de la consulta
        </p>
        <form action="{{ route('reportes.rango.matriculas') }}" method="post" target="_blank">
            @csrf
            <x-input name="inicio" type="date"></x-input>
            <x-input name="fin" type="date" :val="date('Y-m-d')"></x-input>
            <div class="mb-3">
                <button type="submit" class="float-end btn btn-primary">Generar</button>
            </div>
        </form>
    </x-main>
@endsection
