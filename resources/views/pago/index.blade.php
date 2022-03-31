@extends('layout')

@section('title', 'Ver pagos')

@section('content')
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <form class="col-xl-12 col-lg-7">

            <!-- Datos de los pagos -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">VER PAGOS RELIZADOS</h6>
                </div>

                <div class="card-body">
                    <div class="alert alert-danger" role="alert">{{$status ?? ''}}</div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Carnet</th>
                                    <th>Monto C$</th>
                                    <th>Concepto</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pagos as $pago)
                                <tr>
                                    <td>{{$pago->id}}</td>
                                    <td>{{$pago->matricula->nombre}}</td>
                                    <td>{{$pago->matricula->carnet}}</td>
                                    <td>{{$pago->monto}}</td>
                                    <td>{{$pago->concepto}}</td>
                                    <td>{{date("d - F - Y",  strtotime($pago->created_at))}}</td>
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