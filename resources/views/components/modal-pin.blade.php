@props(['person', 'tipo'])

<div class="modal fade" id="restablecer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restablecer PIN</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('cambiar.pin') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="carnet" value="{{ $person->carnet }}">
                <input type="hidden" name="correo" value="{{ $person->correo }}">
                <input type="hidden" name="tipo" value="{{ $tipo }}">
                <div class="modal-body">
                    <p>
                        Esta acción enviará un correo al usuario con el nuevo PIN generado.
                        Esto solo debería usarse en caso que la persona haya perdido sus credenciales
                        y solicite un restablecimiento.
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Restablecer</button>
                </div>
            </form>
        </div>
    </div>
</div>
