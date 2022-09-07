@extends('layout')

@section('title', 'Mensajes')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Mensajes</li>
@endsection

@section('content')
    <x-header-0>Mensajes</x-header-0>
    <x-main>
        <p>
            Mensajes del Curso
        </p>
        <h5 class="fw-bolder">{{$grupo->nombre}} {{$grupo->horario}}</h5>
        @forelse ($mensajes as $mensaje)
            <div style="border-radius: 25px" class="p-3 my-3 bg-secondary bg-opacity-10">
                <div class="small text-primary">
                    {{ date('d F Y', strtotime($mensaje->created_at)) }} -
                    {{ $mensaje->from }}:
                </div>
                {{ $mensaje->contenido }}
                @if ($mensaje->enlace)
                    <a href={{ $mensaje->enlace }} target="_blank">Ir al enlace</a>
                @endif
            </div>
        @empty
            <tr>
                <td>No hay registros</td>
            </tr>
        @endforelse
        <div class="small float-end">{!! $mensajes->links() !!}</div>
    </x-main>
@endsection
