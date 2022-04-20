<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        {{-- <div class="sidebar-brand-icon">
            <i class="fas fa-graduation-cap"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-3">{{config('app.name')}}</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">Administración</div>

    <!-- Nav Item - DOCENTES -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('docente.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Docentes</span></a>
    </li>

    <!-- Nav Item - CURSOS -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('curso.index') }}">
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
        <a class="nav-link" href="{{ route('promotor.index') }}">
            <i class="fas fa-male"></i>
            <span>Promotores</span></a>
    </li>

    <!-- Nav Item - MATRICULA -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('matricula.index') }}">
            <i class="fas fa-address-book"></i>
            <span>Matricula</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
