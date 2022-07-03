@props(['ruta', 'id', 'btn' => 'Actualizar', 'class' => 'col-lg-6'])

<div class="card-body">
    <form action="{{ route($ruta, $id) }}" method="POST">
        @csrf
        @method('PUT')

        {{ $slot }}

        <div class="row">
            <div class=" form-group {{ $class }}">
                <button type="submit" class="btn btn-primary float-right">{{ $btn }}</button>
            </div>
        </div>
    </form>
</div>
