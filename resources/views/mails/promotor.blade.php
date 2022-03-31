<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Admin - StudentPage</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="align-items-center justify-content-center mb-4 mt-4">
                        <h1 class="h3 mb-0 text-gray-800">¡Bienvenido!</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <p>
                                Se ha registrado el usuario <strong>{{ $promotor->nombre }}</strong>
                                con el correo <strong> {{ $promotor->correo }}</strong>
                                al sistema administrativo del instituto {{ $centro->nombre }}
                            </p>
                            <p>
                                A continuación, se muestran sus credenciales
                                con las que podrá realizar las gestiones administrativas que
                                le correspondan según su rol:
                                <br>
                            <h4>ID: {{ $promotor->carnet }} </h4>
                            <h4>PIN: {{ $promotor->pin }}</h4>
                            </p>
                            <p>
                                Asegúrate de no perder esta información, de ser asi recuerde que siempre puede
                                ponerse en contacto con el administrador.
                            </p>
                            <h5>atte. StudentPage Team</h5>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
</body>

</html>
