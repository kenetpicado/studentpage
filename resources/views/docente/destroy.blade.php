@extends('layout')

@section('title', 'Eliminar curso')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7" action="{{ route('docente.destroy', $docente->id) }}" method="POST">
                @csrf
                <!-- Datos-->
                @method('DELETE')
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">ELIMINAR DOCENTE</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            
                            <div class="form-group col-lg-6">
                                <p>
                                    Ha elegido eliminar el docente: <strong> {{$docente->nombre}}</strong>
                                </p>
                                <p>
                                    Con número de carnet: <strong>{{$docente->carnet}}</strong>
                                </p>
                                <p>
                                    Esta acción no se puede deshacer. ¿Quiere continuar?
                                </p>
                                <p>
                                    Si desea cancelar, haga <strong><a href="{{route('docente.create')}}">click aqui</a></strong>  para regresar.
                                </p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Content Row -->

    </div>
@endsection('content')
