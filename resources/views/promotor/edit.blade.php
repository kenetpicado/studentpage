@extends('layout')

@section('title', 'Editar promotor')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-12">

                <div class="card mb-4">
                    <x-header-2 text='Editar'>
                        <x-dp-item modal='restablecer' text="Restablecer PIN"></x-dp-item>
                        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
                    </x-header-2>

                    {{-- MODAL DELETE --}}
                    <x-modal-delete ruta='promotores.destroy' :id="$promotor->id" title="Promotor"></x-modal-delete>

                    {{-- FORM EDIT --}}
                    <x-edit-form ruta='promotores.update' :id="$promotor->id">
                        <x-input-edit label="nombre" :val="$promotor->nombre"></x-input-edit>
                        <x-input-edit label="correo" :val="$promotor->correo" type="email"></x-input-edit>
                        <input type="hidden" name="promotor_id" value="{{ $promotor->id }}">
                    </x-edit-form>
                </div>
            </div>
        </div>
    </div>
@endsection
