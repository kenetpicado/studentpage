@extends('layout')

@section('title', 'Ver pagos')

@section('content')
<div class="container-fluid">

    <!-- Cabecera -->
    <div class="d-sm-flex align-items-center justify-content-between m-2">
        <h1 class="h3 mb-0 text-gray-800">Pagos</h1>
        <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#agregar">
            Agregar <i class="fas fa-plus ml-1"></i>
        </button>
    </div>

    <!-- Content Row -->
    <div class="row">
        <form class="col-xl-12 col-lg-7">

            <!-- Datos de los pagos -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{$matricula->nombre}}</h6>
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
                                    <td>{{date("d-F-Y",  strtotime($pago->created_at))}}</td>
                                    <td>{{$pago->monto}}</td>
                                    <td>{{$pago->concepto}}</td>
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