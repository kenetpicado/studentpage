@extends('layout')

@section('title', 'Crear matrícula')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear</li>
@endsection

@section('content')
    <x-header-0>Crear Matricula</x-header-0>

    <x-form ruta='matriculas.store'>
        <x-input name="nombre"></x-input>
        <x-input name="fecha_nac" label="Fecha de nacimiento" type='date'></x-input>
        <x-input name="cedula"></x-input>
        <x-input name="grado" label="Último grado aprobado"></x-input>
        <x-input name="tutor"></x-input>
        <x-input name="celular" type="number"></x-input>

        @if (auth()->user()->rol == 'admin')
            <x-input name="carnet" label="Carnet - (Opcional)"></x-input>
        @endif

        @if (auth()->user()->sucursal == 'all')
            <x-select name="sucursal" :items="$sucursales"></x-select>
        @endif
        <div class="mb-3">
            <label class="form-label text-muted small">Por favor, revise que todos los datos sean correctos y asegúrese que
                la
                fecha de nacimiento no contenga ningún dígito erróneo, ya que a partir
                de esta se obtendrá el carnet del alumno y una vez generado no se podrá cambiar.</label>
        </div>
    </x-form>

@endsection
