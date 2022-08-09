@extends('layout')

@section('title', 'Reportes')

@section('content')
    <x-header-0>Reportes</x-header-0>

    <div class="card-body">

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <h4 class="card-title">Promotores</h4>
                        <p class="card-text">Reporte general de promotores</p>
                        <a href="{{route('reportes.promotores')}}" class="btn btn-primary" target="_blank">Generar</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card h-100 py-2">
                    <div class="card-body">
                        <h4 class="card-title">Docentes</h4>
                        <p class="card-text">Reporte general de docentes</p>
                        <a href="{{route('reportes.docentes')}}" class="btn btn-primary" target="_blank">Generar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
