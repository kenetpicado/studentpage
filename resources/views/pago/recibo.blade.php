<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/SP.png') }}">
    <title>{{ config('app.name') }} - Recibo</title>
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">

    <style>
        .page {
            width: 21.7cm;
            height: 9.3cm;
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        @page {
            size: 21.7cm 9.3cm;
            margin: 0;
        }

        @media print {
            .ocultar,
            .ocultar * {
                display: none !important;
            }
        }
    </style>
</head>

<body class="bg-light">
    <div class="page" style="background-image: url({{ asset('img/gaita.jpg') }});">
        <div class="card bg-transparent border-0 m-0" style="height: 100%;">
            <div class="row" style="margin-top: 2.85cm; margin-left: 2.4cm;">
                <table>
                    <tr>
                        <td width="62%">{{ $pago->created_at }}</td>
                        <td width="23%">{{ $pago->moneda == 'CORDOBAS' ? $pago->monto : '' }}</td>
                        <td>{{ $pago->moneda == 'DOLARES' ? $pago->monto : '' }}</td>
                    </tr>
                </table>
            </div>
            <div class="row" style="margin-top: 2px; margin-left: 3cm;">
                <td>{{ auth()->user()->name }}</td>
            </div>
            <div class="row" style="margin-top: 0.2cm; margin-left: 4cm;">
                <td>{{ $pago->monto }} {{ $pago->moneda }}</td>
            </div>
            <div class="row" style="margin-top: 0.2cm; margin-left: 4cm;">
                <td>{{ $pago->concepto }}</td>
            </div>
            <div class="row" style="margin-top: 0.2cm; margin-left: 12cm;">
                <td>
                    @if ($pago->saldo)
                        {{ $pago->saldo }} {{ $pago->moneda }}
                    @else
                        ---
                    @endif
                </td>
            </div>
            <div class="row" style="margin-top: 0.2cm; margin-left: 10.4cm;">
                {{ $pago->curso }}
            </div>
            <div class="row" style="margin-top: 0.2cm; margin-left: 2.5cm;">
                <table>
                    <tr>
                        <td width="31%">{{ $pago->horario }}</td>
                        <td>{{ $pago->docente }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <p class="text-center mt-5">
        <a href="javascript:window.print()" class="btn btn-primary ocultar float-center">
            Imprimir
        </a>
    </p>
</body>

</html>
