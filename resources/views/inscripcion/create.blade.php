@extends('layout')

@section('title', 'Inscribir')

@section('bread')
    @if ($type == 'global')
        <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matrículas</a></li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
        <li class="breadcrumb-item"><a href="{{ route('promotores.show', $type) }}">Matrículas</a></li>
    @endif
    <li class="breadcrumb-item active" aria-current="page">Inscribir</li>
@endsection

@section('content')
    <x-header-0>Inscribir</x-header-0>

    <x-create-form ruta='inscripciones.store' btn="Inscribir">
        <div class="mb-1">
            <label class="form-label">{{ $matricula->nombre }}</label>
        </div>
        <x-grupos :grupos="$grupos"></x-grupos>
        <input type="hidden" name="from" value="{{ $type }}">
        <input type="hidden" name="matricula_id" value="{{ $matricula->id }}">
    </x-create-form>
@endsection
