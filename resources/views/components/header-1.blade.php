@props(['modelo'])

<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">{{ $modelo }}</h6>
    <div class="dropdown no-arrow">
        <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#agregar">
            Agregar<i class="fas fa-plus ml-1"></i>
        </button>
    </div>
</div>
