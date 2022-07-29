@props(['text'])

<div class="card-header d-flex align-items-center justify-content-between">
    {{ $text }}

    <div class="dropdown float-end">
        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            {{ $slot }}
        </ul>
    </div>
</div>
