@extends('consulta.layout')

@section('title', 'Detalles del curso')

@section('content')
    <div class="container-fluid">

        <h1 class="h4 text-gray-900">Notas</h1>
        @if (count($inscripcion->notas) > 0)
            <div class="table-responsive">
                <table class="table table-borderless" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="50%">Materia</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscripcion->notas as $nota)
                            <tr>
                                <td>{{ $nota->num }} - {{ $nota->materia }}</td>
                                <td>{{ $nota->valor }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-primary" role="alert">
                No se han registrado
            </div>
        @endif

        <h1 class="h4 text-gray-900">Pagos</h1>
        @if (count($inscripcion->pagos) > 0)
            <div class="table-responsive">
                <table class="table table-borderless" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscripcion->pagos as $pago)
                            <tr>
                                <td>{{ $pago->concepto }}</td>
                                <td>C$ {{ $pago->monto }}</td>
                                <td>{{ $pago->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-primary" role="alert">
                No se han registrado
            </div>
        @endif

        <a href="{{ route('consulta.index') }}" class="btn btn-primary">Regresar</a>

    </div>
@endsection
