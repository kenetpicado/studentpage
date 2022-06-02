@extends('consulta.layout')

@section('title', 'Detalles del curso')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">

            <!-- Area Chart -->
            <div class="col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-uppercase">Notas</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if (count($notas) > 0)
                            <div class="table-responsive">
                                <table class="table table-borderless" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Materia</th>
                                            <th>Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notas as $nota)
                                            <tr>
                                                <td>{{ $nota->num }}</td>
                                                <td>{{ $nota->materia }}</td>
                                                <td>{{ $nota->valor }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                No se han registrado notas en este curso
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Pie Chart -->
            <div class="col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary text-uppercase">Pagos</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if (count($pagos) > 0)
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
                                        @foreach ($pagos as $pago)
                                            <tr>
                                                <td>{{$pago->created_at}}</td>
                                                <td>{{ $pago->concepto }}</td>
                                                <td>C$ {{ $pago->monto }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                No se han registrado pagos en este curso
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('consulta.index') }}" class="btn btn-primary">Regresar</a>
    </div>
@endsection('content')
