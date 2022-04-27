<!-- Agregar-->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="docenteModalCreate"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">AGREGAR UN NUEVO DOCENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('docentes.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre del docente</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                            autocomplete="off" value="{{ old('nombre') }}">
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control @error('correo') is-invalid @enderror" name="correo"
                            autocomplete="off" value="{{ old('correo') }}">

                        @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if (Auth::user()->sucursal == 'all')
                        <div class="form-group">
                            <label for="sucursal">Sucursal</label>
                            <select name="sucursal" class="form-control @error('sucursal') is-invalid @enderror">
                                <option selected disabled value="">Seleccionar</option>
                                <option value="CH" {{ old('sucursal') == 'CH' ? 'selected' : '' }}>CHINANDEGA</option>
                                <option value="MG" {{ old('sucursal') == 'MG' ? 'selected' : '' }}>MANAGUA</option>
                            </select>

                            @error('sucursal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Elimiar-->
<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ELIMINAR DOCENTE</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('docentes.destroy', $docente->id ?? '') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>
                        Esta acción no se puede deshacer.
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Restablecer-->
<div class="modal fade" id="restablecer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restablecer PIN</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('docentes.update', $docente ?? '') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p>
                        Esta acción enviará al correo del docente el nuevo PIN generado.
                    </p>
                    <p>
                        Esta acción solo debería usarse en caso que el usuario haya perdido sus credenciales
                        y solicite un restablecimiento.
                    </p>
                </div>
                <input type="hidden" name="pin" value="">
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Restablecer</button>
                </div>
            </form>
        </div>
    </div>
</div>
