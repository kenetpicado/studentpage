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
            width: 21.6cm;
            min-height: 9.3cm;
            margin: 2cm auto;
            background: white;
        }

        @page {
            size: 21.6cm 9.3cm;
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
    </style>

</head>

<body class="bg-primary">
    <div class="page">
        <table style="padding-left: 2cm;" width="100%">
            <tr class="bg-dark">
                <td width="50%">a</td>
                <td>a</td>
                <td>a</td>
            </tr>
        </table>
    </div>
</body>

</html>
