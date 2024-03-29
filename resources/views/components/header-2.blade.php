@props(['text'])

<div class="card-header d-flex align-items-center justify-content-between">
    <h6 class="m-0 fw-bolder text-primary text-uppercase">{{ $text }}</h6>
    {{-- {{ $text }} --}}
    <div class="dropdown float-end">
        <button style="width: 80px;" class="btn btn-primary btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
            aria-expanded="false">
            Opciones
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            {{ $slot }}
        </ul>
    </div>
</div>
