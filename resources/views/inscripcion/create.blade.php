@extends('layout')

@section('title', 'Inscribir')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                @if ($type == 'global')
                    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matrículas</a></li>
                @else
                    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('promotores.show', $type) }}">Matrículas</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">Inscribir</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-0 text="Inscribir: "> {{ $matricula->nombre }}</x-header-0>

                    {{-- FORM STORE --}}
                    <x-create-form ruta='inscripciones.store' btn="Inscribir">
                        <x-grupos :grupos="$grupos"></x-grupos>
                        <input type="hidden" name="from" value="{{ $type }}">
                        <input type="hidden" name="matricula_id" value="{{ $matricula->id }}">
                    </x-create-form>
                </div>
            </div>
        </div>
    </div>
@endsection
