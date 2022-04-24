@extends('layout')

@section('title', 'Ver pagos')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupo.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupo.show', $grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pagos</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos de los pagos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{$matricula->nombre}} - PAGOS</h6>
                        <div class="dropdown no-arrow">
                            <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#agregar">
                                Agregar <i class="fas fa-plus ml-1"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Monto C$</th>
                                        <th>Concepto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matricula->pagos as $pago)
                                        <tr>
                                            <td>{{ $pago->created_at }}</td>
                                            <td>{{ $pago->monto }}</td>
                                            <td>{{ $pago->concepto }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <!-- Content Row -->

    </div>
@endsection('content')

@section('agregarModal')
    @include('pago.modal')
@endsection

@section('re-open')
    @if ($errors->any())
        <script>
            $('#agregar').modal('show')
        </script>
    @endif
@endsection
