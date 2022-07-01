@extends('consulta.layout')

@section('title', 'Pagos')

@section('content')
    <h1 class="h4 text-gray-900 mb-4">Pagos</h1>

    @if (count($pagos) > 0)
        <div class="table-responsive">
            <table class="table table-borderless" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                        <tr>
                            <td>{{ $pago->concepto }}</td>
                            <td>{{ $pago->monto }}</td>
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

    <a href="{{ route('consulta.index') }}" class="btn btn-primary float-right">Regresar</a>
@endsection
