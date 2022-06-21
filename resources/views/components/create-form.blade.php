@props(['ruta', 'btn' => 'Guardar'])

<div class="card-body">
    <form action="{{ route($ruta) }}" method="POST">
        @csrf

        {{ $slot }}

        <div class="row">
            <div class=" form-group col-lg-6">
                <button type="submit" class="btn btn-primary float-right">{{$btn}}</button>
            </div>
        </div>
    </form>
</div>