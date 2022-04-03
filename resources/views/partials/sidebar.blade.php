<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">StudentPage</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">Administración</div>

    <!-- MATRICULA -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMatricula"
            aria-expanded="true" aria-controls="collapseMatricula">
            <i class="fas fa-address-book"></i>
            <span>Matrícula</span>
        </a>
        <div id="collapseMatricula" class="collapse" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones:</h6>
                <a class="collapse-item" href="{{ route('matricula.create') }}">Agregar matricula</a>
                <a class="collapse-item" href="{{ route('matricula.index') }}">Ver matriculas</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - MATRICULA -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('matricula.index') }}">
            <i class="fas fa-address-book"></i>
            <span>Matricula</span></a>
    </li>

    <!-- CAJA -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCaja"
            aria-expanded="true" aria-controls="collapseCaja">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Caja</span>
        </a>
        <div id="collapseCaja" class="collapse" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones:</h6>
                <a class="collapse-item" href="{{ route('pago.create') }}">Registrar pago</a>
                <a class="collapse-item" href="{{ route('pago.index') }}">Ver pagos</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - DOCENTES -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('docente.create') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Docentes</span></a>
    </li>

    <!-- Nav Item - CURSOS -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('curso.create') }}">
            <i class="fas fa-clone"></i>
            <span>Cursos</span></a>
    </li>

    <!-- Nav Item - CURSOS -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('grupo.index') }}">
            <i class="fas fa-users"></i>
            <span>Grupos</span></a>
    </li>

    <!-- Nav Item - PROMOTORES-->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('promotor.create') }}">
            <i class="fas fa-male"></i>
            <span>Promotores</span></a>
    </li>

    <!-- Nav Item - CENTRO-->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('centro.create') }}">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Centro</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->