<!-- Sidebar -->
<ul class="navbar-nav bg-primary sidebar sidebar-dark">

    <div class="position-fixed">

        <li class="nav-item">
            <div class="nav-link">
                <i class="fas fa-fw fa-home"></i>
                <span>{{ config('app.name') }}</span>
            </div>
        </li>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Admin</div>

        @if (Auth::user()->rol == 'admin')
            <li class="nav-item {{ request()->is('docentes*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('docentes.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Docentes</span></a>
            </li>

            <li class="nav-item {{ request()->is('cursos*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('cursos.index') }}">
                    <i class="fas fa-clone"></i>
                    <span>Cursos</span></a>
            </li>

            <li class="nav-item {{ request()->is('promotores*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('promotores.index') }}">
                    <i class="fas fa-male"></i>
                    <span>Promotores</span></a>
            </li>
        @endif

        @if (Auth::user()->rol == 'docente' || Auth::user()->rol == 'admin')
            <li class="nav-item {{ request()->is('grupos*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('grupos.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Grupos</span></a>
            </li>
        @endif

        @if (Auth::user()->rol == 'promotor' || Auth::user()->rol == 'admin')
            <li class="nav-item {{ request()->is('matriculas*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('matriculas.index') }}">
                    <i class="fas fa-address-book"></i>
                    <span>Matriculas</span></a>
            </li>
        @endif
    </div>

</ul>
