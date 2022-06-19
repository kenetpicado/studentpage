<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="{{ config('app.name') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('img/SP.png') }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    {{-- normalize --}}
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    {{-- SWEETALERT --}}
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- LOADER -->
    <link href="{{ asset('css/loader.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    
    <div id="wrapper">

        @include('partials.sidebar')
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                @include('partials.topbar')
                @yield('content')

            </div>

            @include('partials.footer')
        </div>
    </div>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @yield('agregarModal')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    {{-- sweetalert2 --}}
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

    {{-- funciones extras --}}
    <script src="{{ asset('js/functions.js') }}"></script>

    @yield('re-open')

    @if (session('info'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "<?php echo session('info'); ?>",
                showConfirmButton: false,
                timer: 1000
            })
        </script>
    @endif

    @if (session('deleted'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "<?php echo session('deleted'); ?>",
                showConfirmButton: false,
                timer: 1000
            })
        </script>
    @endif
</body>

</html>
