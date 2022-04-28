<!-- Agregar-->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="docenteModalCreate"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">PAGAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('pagos.store') }}" method="POST">
                <div class="modal-body">
                    @csrf

                    <div class="row">
                        <div class="form-group col-6">
                            <label>Tipo</label>
                            <select name="tipo" id="tipo"  class="form-control @error('tipo') is-invalid @enderror">
                                <option value="1" {{ old('tipo') == '1' ? 'selected' : '' }}>MENSUALIDAD</option>
                                <option value="0" {{ old('tipo') == '0' ? 'selected' : '' }}>OTRO</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>Concepto</label>
                            <input type="text" id="concepto" class="form-control @error('concepto') is-invalid @enderror"
                                name="concepto" disabled autocomplete="off" value="{{ old('concepto') }}">

                            @error('concepto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Recibo</label>
                        <input type="text" class="form-control @error('recibo') is-invalid @enderror" name="recibo"
                            autocomplete="off" value="{{ old('recibo') }}">

                        @error('recibo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="monto">Monto a pagar (C$)</label>
                        <input type="number" class="form-control @error('monto') is-invalid @enderror" name="monto"
                            autocomplete="off" value="{{ old('monto') }}">

                        @error('monto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="matricula_id" value="{{ $matricula->id }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
