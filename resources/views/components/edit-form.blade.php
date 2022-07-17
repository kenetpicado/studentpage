@props(['ruta', 'id', 'btn' => 'Actualizar'])

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card-body">
            <form action="{{ route($ruta, $id)  }}" method="post">
                @csrf
                @method('put')
                {{ $slot }}
                <button type="submit" class="btn btn-primary rounded-3">{{ $btn }}</button>
            </form>
        </div>
    </div>
</div>
