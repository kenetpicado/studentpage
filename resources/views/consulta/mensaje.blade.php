@extends('consulta.layout')

@section('title', 'Mensajes')

@section('content')
    <h1 class="h4 text-gray-900 mb-4">Mensajes</h1>

    @if (count($mensajes) > 0)
        @foreach ($mensajes as $mensaje)
            <div class="row mb-3">
                <div class="col">
                    <div style="border: 1px; border-radius: 25px" class="p-3 bg-gray-200 shadow-md">
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
            </div>
        @endforeach
    @else
        <div class="alert alert-primary" role="alert">
            No se han registrado
        </div>
    @endif
    <a href="{{ route('consulta.index') }}" class="btn btn-primary float-right">Regresar</a>
@endsection
