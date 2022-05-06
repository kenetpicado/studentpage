@extends('consulta.layout')

@section('title', 'Consulta')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">DATOS DEL ALUMNO</h6>
                    </div>

                    <div class="card-body">
                        <div class="ml-2">
                            <p>Nombre: <strong>{{ $user->nombre }}</strong></p>
                            <p>Carnet: <strong>{{ $user->carnet }}</strong></p>
                        </div>

                        @if (count($pivot) == 0)
                            <div class="alert alert-danger" role="alert">
                                No hay cursos
                            </div>
                        @else
                            <div class="row">
                                @foreach ($pivot as $gm)
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $gm->grupo->curso->nombre }}</h5>
                                                <p class="card-text">
                                                    Docente: {{ $gm->grupo->docente->nombre }}
                                                    <br>
                                                    Horario: {{ $gm->grupo->horario }}
                                                    <br>
                                                    Año: {{ $gm->grupo->anyo }}
                                                </p>
                                                <a href="{{ route('consulta.notas', $gm->id) }}"
                                                    class="btn btn-primary">Ver notas</a>
                                                <a href="{{ route('consulta.pagos', $gm->id) }}"
                                                    class="btn btn-secondary">Ver pagos</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection('content')