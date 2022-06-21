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
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
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
                        <div class="col-xl-12 col-lg-7">
                            <!-- Datos -->
                            <div class="card" id="seleccion">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Reporte de Notas -
                                        {{ $grupo->curso->nombre }}</h6>
                                    <div class="dropdown no-arrow">

                                    </div>
                                </div>

                                <div class="card-body">
                                    <p>Docente: <strong>{{ $grupo->docente->nombre }}</strong></p>
                                    <p>Horario: <strong>{{ $grupo->horario }}</strong></p>
                                    @if ($grupo->sucursal == 'CH')
                                        <p>Sucusal: <strong>Chinandega</strong></p>
                                    @else
                                        <p>Sucusal: <strong>Managua</strong></p>
                                    @endif
                                    <p>Fecha: <strong>{{ date('d-m-Y') }}</strong> </p>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" width="100%" cellspacing="0">

                                            <thead>
                                                <th>Carnet</th>
                                                <th>Nombre</th>
                                                <th colspan="{{ count($inscripciones->first()->notas) }}"
                                                    class="center-babe">Materias
                                                </th>
                                            </thead>
                                            <tbody>
                                                @foreach ($inscripciones as $alumno)
                                                    <tr>
                                                        <td style="vertical-align:middle;">
                                                            {{ $alumno->matricula->carnet }}
                                                        </td>
                                                        <td style="vertical-align:middle;">
                                                            {{ $alumno->matricula->nombre }}
                                                        </td>
                                                        @foreach ($alumno->notas as $nota)
                                                            <td>
                                                                <small>{{ $nota->num }}-{{ $nota->materia }} </small>
                                                                <br>
                                                                <strong>{{ $nota->valor }}</strong>
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <input type="button" class="btn btn-primary my-2" onclick="printDiv('seleccion');"
                                value="Imprimir" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printDiv(nombreDiv) {
            var contenido = document.getElementById(nombreDiv).innerHTML;
            var contenidoOriginal = document.body.innerHTML;
            document.body.innerHTML = contenido;
            window.print();
            document.body.innerHTML = contenidoOriginal;
        }
    </script>
</body>

</html>
