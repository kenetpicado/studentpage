@props(['ruta', 'btn' => 'Guardar'])

<div class="row justify-content-center mb-4">
    <div class="col-lg-6">
        <div class="card-body">
            <form action="{{ route($ruta)  }}" method="post">
                @csrf
                {{ $slot }}
                <div class="mb-3">
                    <button type="submit" class="float-end btn btn-primary rounded-3">{{ $btn }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
