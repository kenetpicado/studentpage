<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/SP.png') }}">
    <title>{{ config('app.name') }} | Recibo</title>
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">

    <style>
        .page {
            width: 21cm;
            min-height: 29.7cm;
            margin: 1cm auto;
            background: white;
        }

        .subpage {
            padding: 0.5cm;
            height: 14.8cm;
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

    <div class="book">
        <div class="page">
            <div class="subpage">
                <table class="table table-borderless" style="height: 100%" width="100%">
                    <tbody>
                        <tr>
                            <th colspan="2">
                                <img src="{{asset('img/logoms.png')}}" alt="" srcset="" width="60%" height="auto">
                            </th>
                            <th class="text-end">
                                @if ($pago->sucursal == 'MG')
                                    SERIE "A"
                                @else
                                    SERIE "B"
                                @endif
                                <br>
                                N° {{ $pago->id }}
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-center">RECIBO DE CAJA</th>
                        </tr>
                        <tr>
                            <td style="width: 25%">Fecha</td>
                            <td style="width: 35%">{{ $pago->created_at }}</td>
                            <td class="fw-bolder">
                                @if ($pago->moneda == 'DOLARES')
                                    POR U$ {{ $pago->monto }} ({{ $pago->moneda }})
                                @else
                                    POR C$ {{ $pago->monto }} ({{ $pago->moneda }})
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>Alumno:</td>
                            <td>{{$pago->nombre}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Recibi de</td>
                            <td>{{ auth()->user()->name }}</td>
                            <td rowspan="4">
                                Nota
                                <p class="small lh-sm">* Conserve este recibo de caja, sin el no aceptamos reclamos
                                    posteriores.</p>
                                <p class="small lh-sm">* Para su validez este recibo deberá estar firmado y sellado por
                                    el
                                    cajero, en caso contario será nulo.</p>
                                <p class="small">Claro: 8637-9364 | Tigo: 7876-3867</p>
                                <p class="small">RUC: J0310000144397</p>
                            </td>
                        </tr>
                        <tr>
                            <td>La cantidad de</td>
                            <td>{{ $pago->monto }} {{ $pago->moneda }}</td>
                        </tr>
                        <tr>
                            <td>En concepto de</td>
                            <td>{{ $pago->concepto }}</td>
                        </tr>
                        <tr>
                            <td>Saldo</td>
                            <td>{{$pago->saldo ?? '-'}}  {{ $pago->moneda }}</td>
                        </tr>
                        <tr>
                            <td>Curso</td>
                            <td>{{ $pago->curso }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Horario</td>
                            <td>{{ $pago->horario }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Instructor</td>
                            <td>{{ $pago->docente }}</td>
                            <td class="text-center">
                                <hr class="m-0"> Firma y Sello (Cajero General)
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="subpage">
                <table class="table table-borderless" style="height: 100%" width="100%">
                    <tbody>
                        <tr>
                            <th colspan="2">
                                <img src="{{asset('img/logoms.png')}}" alt="" srcset="" width="60%" height="auto">
                            </th>
                            <th class="text-end">
                                @if ($pago->sucursal == 'MG')
                                    SERIE "A"
                                @else
                                    SERIE "B"
                                @endif
                                <br>
                                N° {{ $pago->id }}
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-center">RECIBO DE CAJA</th>
                        </tr>
                        <tr>
                            <td style="width: 25%">Fecha</td>
                            <td style="width: 35%">{{ $pago->created_at }}</td>
                            <td class="fw-bolder">
                                @if ($pago->moneda == 'DOLARES')
                                    POR U$ {{ $pago->monto }} ({{ $pago->moneda }})
                                @else
                                    POR C$ {{ $pago->monto }} ({{ $pago->moneda }})
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>Alumno:</td>
                            <td>{{$pago->nombre}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Recibi de</td>
                            <td>{{ auth()->user()->name }}</td>
                            <td rowspan="4">
                                Nota
                                <p class="small lh-sm">* Conserve este recibo de caja, sin el no aceptamos reclamos
                                    posteriores.</p>
                                <p class="small lh-sm">* Para su validez este recibo deberá estar firmado y sellado por
                                    el
                                    cajero, en caso contario será nulo.</p>
                                <p class="small">Claro: 8637-9364 | Tigo: 7876-3867</p>
                                <p class="small">RUC: J0310000144397</p>
                            </td>
                        </tr>
                        <tr>
                            <td>La cantidad de</td>
                            <td>{{ $pago->monto }} {{ $pago->moneda }}</td>
                        </tr>
                        <tr>
                            <td>En concepto de</td>
                            <td>{{ $pago->concepto }}</td>
                        </tr>
                        <tr>
                            <td>Saldo</td>
                            <td>{{$pago->saldo ?? '-'}}  {{ $pago->moneda }}</td>
                        </tr>
                        <tr>
                            <td>Curso</td>
                            <td>{{ $pago->curso }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Horario</td>
                            <td>{{ $pago->horario }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Instructor</td>
                            <td>{{ $pago->docente }}</td>
                            <td class="text-center">
                                <hr class="m-0"> Firma y Sello (Cajero General)
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
