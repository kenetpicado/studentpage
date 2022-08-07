<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/SP.png') }}">
    <title>Matricula - Comprobante</title>
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">

    <style>
        .page {
            width: 21cm;
            min-height: 29.7cm;
            margin: 1cm auto;
            background: white;
            padding: 1.5cm;
        }

        .subpage {
            height: 26cm;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                background: initial;
                page-break-after: always;
            }

            .ocultar,
            .ocultar * {
                display: none !important;
            }
        }

        tr {
            vertical-align: middle;
        }

        hr {
            border-top: solid 1px rgb(7, 7, 7);
        }
    </style>

</head>

<body class="bg-light">
    <div class="page">
        <div class="subpage">
            <table class="table table-borderless" style="height: 75%" width="100%">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">
                            <img src="{{ asset('img/logoms.png') }}" alt="" srcset="" width="30%"
                                height="auto">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" class="text-center h5"><strong>{{ config('app.centro') }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center h6">Matricula
                            {{ date('Y', strtotime($matricula->created_at)) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">Datos de la matricula</th>
                    </tr>
                    <tr>
                        <td>Carnet</td>
                        <td><strong>{{ $matricula->carnet }}</strong></td>
                    </tr>
                    <tr>
                        <td>PIN</td>
                        <td><strong>{{ $matricula->pin }}</strong></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td>{{ $matricula->nombre }}</td>
                    </tr>
                    <tr>
                        <td>Cédula</td>
                        <td>{{ $matricula->cedula }}</td>
                    </tr>
                    <tr>
                        <td>Fecha de nacimiento</td>
                        <td>{{ $matricula->fecha_nac }}</td>
                    </tr>
                    <tr>
                        <td>Celular</td>
                        <td>{{ $matricula->celular }}</td>
                    </tr>
                    <tr>
                        <td>Tutor</td>
                        <td>{{ $matricula->tutor }}</td>
                    </tr>
                    <tr>
                        <td>Fecha de matricula</td>
                        <td>{{ $matricula->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Ultimo grado aprobado</td>
                        <td>{{ $matricula->grado }}</td>
                    </tr>
                    <tr>
                        <td>Sucursal</td>
                        <td>
                            @if ($matricula->sucursal == 'CH')
                                Chinandega
                            @else
                                Managua
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="javascript:window.print()" class="btn btn-primary ocultar float"> Imprimir</a>
    </div>
</body>

</html>
