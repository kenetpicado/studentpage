@extends('layout')

@section('title', 'Perfil')

@section('content')
    <x-header-0>Perfil</x-header-0>

    <x-main>
        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <x-input name='name' label="Nombre" :val="$user->name"></x-input>
            <button type="submit" class="btn btn-secondary rounded-3 float-end">Actualizar</button>
        </form>
    </x-main>

    <x-main>
        <hr>
        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <x-input name='password' label="Nueva contraseña" type="password"></x-input>
            <x-input name='password_confirmation' label="Confirmar contraseña" type="password"></x-input>
            <button type="submit" class="btn btn-secondary rounded-3 float-end">Cambiar contraseña</button>
        </form>
    </x-main>
@endsection
