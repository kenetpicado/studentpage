@props(['ruta', 'id', 'btn' => 'Actualizar'])

<div class="card-body">
    <form action="{{ route($ruta, $id) }}" method="POST">
        @csrf
        @method('PUT')

        {{ $slot }}

        <div class="row">
            <div class=" form-group col-lg-6">
                <button type="submit" class="btn btn-primary float-right">{{ $btn }}</button>
            </div>
        </div>
    </form>
</div>
