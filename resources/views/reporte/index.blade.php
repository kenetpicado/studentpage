@extends('layout')

@section('title', 'Reportes')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Reportes</li>
@endsection

@section('content')
    <x-header-0>Reportes</x-header-0>

    <div class="card-body">

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <h4 class="card-title">Promotores</h4>
                        <p class="card-text">Reporte general de promotores</p>
                        <a href="{{ route('reportes.promotores') }}" class="btn btn-primary" target="_blank">Generar</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <h4 class="card-title">Docentes</h4>
                        <p class="card-text">Reporte general de docentes</p>
                        <a href="{{ route('reportes.docentes') }}" class="btn btn-primary" target="_blank">Generar</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <h4 class="card-title">Grupos</h4>
                        <p class="card-text">Reporte general de grupos</p>
                        <a href="{{ route('reportes.grupos') }}" class="btn btn-primary" target="_blank">Generar</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <h4 class="card-title">Notas</h4>
                        <p class="card-text">Reporte de notas de cada grupo</p>
                        <a href="{{ route('reportes.notas') }}" class="btn btn-primary">Ver grupos</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <x-main>
            <form action="{{ route('reportes.rango.promotor') }}" method="post" target="_blank">
                @csrf
                <p class="text-primary">
                    Generar reporte de un Promotor específico en un rango de fechas determinado por el administrador.
                    Por favor, ingrese la fecha de inicio y fin de la consulta y el carnet del Promotor.
                </p>
                <x-input name="inicio" type="date"></x-input>
                <x-input name="fin" type="date" :val="date('Y-m-d')"></x-input>
                <x-input name="carnet"></x-input>
                <div class="mb-3">
                    <button type="submit" class="float-end btn btn-primary rounded-3">Generar</button>
                </div>
            </form>
        </x-main>
        <hr>
        <x-main>
            <form action="{{ route('reportes.rango.matriculas') }}" method="post" target="_blank">
                @csrf
                <p class="text-primary">
                    Generar reporte de todas las matrículas en un rango de fechas determinado por el administrador.
                    Por favor, ingrese la fecha de inicio y fin de la consulta
                </p>
                <x-input name="inicio" type="date"></x-input>
                <x-input name="fin" type="date" :val="date('Y-m-d')"></x-input>
                <div class="mb-3">
                    <button type="submit" class="float-end btn btn-primary rounded-3">Generar</button>
                </div>
            </form>
        </x-main>
    </div>
@endsection
