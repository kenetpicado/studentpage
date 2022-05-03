<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="{{ config('app.name') }}">

    <title>{{ $grupo->curso->nombre }} - Reporte de notas</title>

    <!-- Custom fonts for this template-->
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    {{-- normalize --}}
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
                        <form class="col-xl-12 col-lg-7">

                            <!-- Datos -->
                            <div class="card">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">REPORTE DE NOTAS -
                                        {{ $grupo->curso->nombre }}</h6>
                                    <div class="dropdown no-arrow">
                                        <a href="javascript:window.print()"> Imprimir</a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <p>Docente: <strong>{{ $grupo->docente->nombre }}</strong></p>
                                    <p>Horario: <strong>{{ $grupo->horario }}</strong></p>
                                    <p>Fecha: <strong>{{date('d-m-Y')}}</strong> </p>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                            <thead>
                                                <th>Nombre</th>
                                                <th>Carnet</th>
                                                @foreach ($modulos as $modulo)
                                                    <th>{{ $modulo->unidad }}</th>
                                                @endforeach
                                            </thead>
                                            <tbody>
                                                @foreach ($pivot as $alumno)
                                                    <tr>
                                                        <td>{{ $alumno->matricula->nombre }}</td>
                                                        <td>{{ $alumno->matricula->carnet }}</td>
                                                        @foreach ($alumno->notas as $nota)
                                                            <td>{{ $nota->valor }}</td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
