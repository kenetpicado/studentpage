@extends('layout')

@section('title', 'Mensajes')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Mensajes</li>
@endsection

@section('content')
    <x-header-0>Mensajes</x-header-0>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if (count($mensajes) > 0)
                    @foreach ($mensajes as $mensaje)
                        <div class="card-body">
                            <div style="border-radius: 25px" class="p-3 bg-secondary bg-opacity-10">
                                <div class="small text-primary">
                                    {{ date('d F Y', strtotime($mensaje->created_at)) }} -
                                    {{ $mensaje->from }}:
                                </div>
                                {{ $mensaje->contenido }}
                                @if ($mensaje->enlace)
                                    <a href={{ $mensaje->enlace }} target="_blank">Ir al enlace</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-primary" role="alert">
                        No se han registrado
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
