@extends('layout')

@section('title', 'Editar promotor')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-0>Editar</x-header-0>

    <x-edit-form ruta='promotores.update' :id="$promotor->id">
        <x-input name="nombre" :val="$promotor->nombre"></x-input>
        <x-input name="correo" :val="$promotor->correo" type="email"></x-input>
        <input type="hidden" name="promotor_id" value="{{ $promotor->id }}">
    </x-edit-form>

    <x-create-form ruta="cambiar.pin" btn="Restablecer">
        @method('PUT')
        <hr>
        <h4 class="mb-3">Restablecer PIN</h4>
        <p>
            Esta acción enviará un correo a <strong>{{ $promotor->correo }}</strong> con el nuevo PIN generado.
            Esto solo debería usarse en caso que el promotor(a) <strong>{{ $promotor->nombre }}</strong> haya perdido sus credenciales
            y solicite un restablecimiento.
        </p>
        <input type="hidden" name="carnet" value="{{ $promotor->carnet }}">
        <input type="hidden" name="correo" value="{{ $promotor->correo }}">
        <input type="hidden" name="tipo" value="promotores">
    </x-create-form>

    <x-edit-form ruta="promotores.destroy" :id="$promotor->id" btn="Eliminar" method="delete">
        <hr>
        <h4 class="mb-3">Eliminar</h4>
        <p>
            Se conservan todas las Matrículas que hayan sido realizadas por el Promotor <strong>{{ $promotor->nombre }}</strong>.
        </p>
        <p class="text-danger small">
            Esta opción no se puede deshacer.
        </p>
    </x-edit-form>
@endsection
