@extends('layout')

@section('title', 'Inicio')

@section('content')
    <x-header-0>Informacion general</x-header-0>
    <div class="card-body">

        <div class="row">
            <x-card>
                <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                    <a href="{{ route('promotores.index') }}">Promotores</a>
                </div>
                <div class="h5 mb-0 fw-bolder">{{ $info['promotores_total'] }}</div>
                @slot('icon')
                    <i class="fas fa-user fa-2x text-secondary text-opacity-25"></i>
                @endslot
            </x-card>

            <x-card>
                <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                    <a href="{{ route('docentes.index') }}">Docentes</a>
                </div>
                <div class="h5 mb-0 fw-bolder">{{ $info['docentes_total'] }}</div>
                @slot('icon')
                    <i class="fas fa-user fa-2x text-secondary text-opacity-25"></i>
                @endslot
            </x-card>

            <x-card>
                <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                    <a href="{{ route('cursos.index') }}">Cursos</a>
                </div>
                <div class="h5 mb-0 fw-bolder">{{ $info['cursos_total'] }}</div>
                @slot('icon')
                    <i class="fas fa-laptop-code fa-2x text-secondary text-opacity-25"></i>
                @endslot
            </x-card>

            <x-card>
                <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                    <a href="{{ route('grupos.index') }}">Grupos</a>
                </div>
                <div class="h5 mb-0 fw-bolder">{{ $info['grupos_total'] }}</div>
                @slot('icon')
                    <i class="fas fa-comment fa-2x text-secondary text-opacity-25"></i>
                @endslot
            </x-card>

            <x-card>
                <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                    <a href="{{ route('grupos.index') }}">Grupos 2022</a>
                </div>
                <div class="h5 mb-0 fw-bolder">{{ $info['grupos_anyo'] }}</div>
                @slot('icon')
                    <i class="fas fa-comment fa-2x text-secondary text-opacity-25"></i>
                @endslot
            </x-card>

            <x-card>
                <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                    <a href="{{ route('matriculas.index') }}">Matriculas</a>
                </div>
                <div class="h5 mb-0 fw-bolder">{{ $info['matriculas_total'] }}</div>
                @slot('icon')
                    <i class="fas fa-users fa-2x text-secondary text-opacity-25"></i>
                @endslot
            </x-card>

            <x-card>
                <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                    <a href="{{ route('matriculas.index') }}">Matriculas 2022</a>
                </div>
                <div class="h5 mb-0 fw-bolder">{{ $info['matriculas_anyo'] }}</div>
                @slot('icon')
                    <i class="fas fa-users fa-2x text-secondary text-opacity-25"></i>
                @endslot
            </x-card>
        </div>
    </div>
@endsection
