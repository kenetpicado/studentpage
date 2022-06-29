<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="{{ config('app.name') }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('img/SP.png') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    {{-- normalize --}}
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body class="bg-light">

    @include('partials.topbar')

    <div class="container ">

        <div class="row justify-content-center">

            <div class="col-lg-10">
                <div class="card o-hidden border-0 my-5" style="border-radius: 0px">
                    <div class="card-body p-0">
                        <div class="p-5">

                            @yield('content')
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
