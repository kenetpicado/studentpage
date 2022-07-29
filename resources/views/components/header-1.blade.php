@props(['ruta', 'id' => ''])

<div class="card-header d-flex align-items-center justify-content-between">
    {{ $slot }}
    <a href="{{ route($ruta, $id) }}" class="btn btn-sm btn-primary rounded-3 float-end">
        Agregar
    </a>
</div>
