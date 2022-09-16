@props(['ruta', 'id' => ''])

<div class="card-header d-flex align-items-center justify-content-between">
    <h6 class="m-0 fw-bolder text-primary text-uppercase">{{ $slot }}</h6>
    {{-- {{ $slot }} --}}
    <a href="{{ route($ruta, $id) }}" class="btn btn-sm btn-primary" style="width: 80px;">
        Agregar
    </a>
</div>
