<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="{{ config('app.name') }}">

    <title>Reporte de notas - {{ $grupo->curso_nombre }}</title>

    <!-- Custom fonts for this template-->
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body>

    <div class="row">
        <div class="col-lg-12">

            <div class="card" id="seleccion">
                <x-header-0 text="Reporte de notas: ">{{ $grupo->curso_nombre }}</x-header-0>

                <div class="card-body">
                    <p>Docente: <strong>{{ $grupo->docente_nombre }}</strong></p>
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

                                @foreach ($inscripciones->first()->notas as $nota)
                                    <th>{{$nota->materia}}</th>
                                @endforeach
                            </thead>
                            <tbody>
                                @foreach ($inscripciones as $inscripcion)
                                    <tr>
                                        <td>{{ $inscripcion->matricula_carnet }}</td>
                                        <td>{{ $inscripcion->matricula_nombre }}</td>

                                        @foreach ($inscripcion->notas as $nota)
                                            <td>{{ $nota->valor }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <input type="button" class="btn btn-primary my-2" onclick="printDiv('seleccion');" value="Imprimir" />
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
