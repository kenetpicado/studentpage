@props(['ruta', 'title', 'lg' => ''])

<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="ModalCreate" aria-hidden="true">
    <div class="modal-dialog {{ $lg }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }} - Agregar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($ruta) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
