<nav class="navbar navbar-expand-lg navbar-light bg-white static-top shadow-sm mb-3">
    <div class="container">
        <a class="navbar-brand fw-bolder text-primary" href="/">{{ config('app.name') }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                @if (Auth::user()->rol == 'admin')
                    <x-itembar when="docentes" text="Docentes" route="docentes.index"></x-itembar>
                    <x-itembar when="cursos" text="Cursos" route="cursos.index"></x-itembar>
                    <x-itembar when="promotores" text="Promotores" route="promotores.index"></x-itembar>
                @endif

                @if (Auth::user()->rol == 'docente' || Auth::user()->rol == 'admin')
                    <x-itembar when="grupos" text="Grupos" route="grupos.index"></x-itembar>
                @endif

                @if (Auth::user()->rol == 'promotor' || Auth::user()->rol == 'admin')
                    <x-itembar when="matriculas" text="Matriculas" route="matriculas.index"></x-itembar>
                @endif
                
                @if (Auth::user()->rol == 'admin')
                    <x-itembar when="reportes" text="Reportes" route="docentes.index"></x-itembar>
                @endif
            </ul>

            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name ?? '' }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a href="#" class="dropdown-item">Perfil</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
