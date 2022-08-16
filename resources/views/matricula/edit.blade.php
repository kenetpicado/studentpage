@extends('layout')

@section('title', 'Editar matrícula')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-0>Editar</x-header-0>

    <x-edit-form ruta='matriculas.update' :id="$matricula->id">
        <x-input name="nombre" :val="$matricula->nombre"></x-input>
        <x-input name="fecha_nac" label="Fecha de nacimiento" :val="$matricula->fecha_nac" type="date">
        </x-input>
        <x-input name="cedula" text="Cédula" :val="$matricula->cedula"></x-input>
        <x-input name="grado" text="Ultimo grado aprobado" :val="$matricula->grado"></x-input>
        <x-input name="tutor" :val="$matricula->tutor"></x-input>
        <x-input name="celular" :val="$matricula->celular"></x-input>
    </x-edit-form>

    <x-edit-form ruta="matriculas.destroy" :id="$matricula->id" btn="Eliminar" method="delete">
        <hr>
        <h5 class="mb-3">Eliminar Matrícula</h5>
        <p>
            Solo es posible eliminar una Matrícula que no tenga inscripción en un grupo.
            De no ser así, primero elimine la inscripción y luego elimine la Matrícula.
            <br>
            Tenga en cuenta que toda la información relacionada con los pagos también se eliminará.
        </p>
        <p class="text-primary">
            Esta opción no se puede deshacer.
        </p>
    </x-edit-form>

@endsection
