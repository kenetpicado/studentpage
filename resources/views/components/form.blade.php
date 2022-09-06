@props(['ruta', 'btn' => 'Guardar', 'id' => '', 'deny' => ''])

<div class="row justify-content-center mb-4">
    <div class="col-lg-6">
        <div class="card-body">
            <form action="{{ route($ruta, $id) }}" method="post">
                @csrf
                {{ $slot }}
                @if ($deny)
                    <p class="small text-primary">Actualmente no tiene permisos para editar este registro.</p>
                @else
                    <div class="my-2 float-end">
                        <button type="submit"
                            class="btn {{ $btn == 'Eliminar' ? 'btn-danger' : 'btn-primary' }}">{{ $btn }}</button>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
