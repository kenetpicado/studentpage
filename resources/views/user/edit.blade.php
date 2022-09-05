@extends('layout')

@section('title', 'Perfil')

@section('content')
    <x-header-0>Perfil</x-header-0>

    <x-form ruta="user.update" :id="$user->id" btn="Actualizar">
        @method('PUT')
        <x-input name='name' label="Nombre" :val="$user->name"></x-input>
    </x-form>
    
    <x-form ruta="user.update" :id="$user->id" btn="Actualizar">
        <hr>
        @method('PUT')
        <x-input name='password' label="Nueva contraseña" type="password"></x-input>
        <x-input name='password_confirmation' label="Confirmar contraseña" type="password"></x-input>
    </x-form>
@endsection
