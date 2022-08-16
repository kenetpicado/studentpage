@props(['ruta', 'id', 'btn' => 'Actualizar', 'method' => 'put'])

<div class="row justify-content-center mb-4">
    <div class="col-lg-6">
        <div class="card-body">
            <form action="{{ route($ruta, $id) }}" method="post">
                @csrf
                @method($method)
                {{ $slot }}
                <button type="submit"
                    class="float-end btn btn-primary @if ($method == 'delete') btn-danger @endif rounded-3">{{ $btn }}</button>
            </form>
        </div>
    </div>
</div>
