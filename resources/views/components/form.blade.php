@props(['ruta', 'btn' => 'Guardar', 'id' => ''])

<div class="row justify-content-center mb-4">
    <div class="col-lg-6">
        <div class="card-body">
            <form action="{{ route($ruta, $id) }}" method="post">
                @csrf
                {{ $slot }}
                <div class="my-2 float-end">
                    <button type="submit" class="btn {{ $btn == 'Eliminar' ? 'btn-danger' : 'btn-primary' }}"
                        style="width: 150px;">{{ $btn }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
