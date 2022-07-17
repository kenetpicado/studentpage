@props(['text'])

<div class="card-header bg-white border-0 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 fw-bolder text-primary">{{ $text }}</h6>

    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            {{ $slot }}
        </ul>
    </div>
</div>
