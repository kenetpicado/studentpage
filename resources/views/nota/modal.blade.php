<!-- Agregar-->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="docenteModalCreate"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Agregar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('notas.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Número de materia</label>
                        <input type="number" class="form-control @error('num') is-invalid @enderror" name="num"
                            autocomplete="off" value="{{ old('num') }}">

                        @error('num')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="materia">Materia</label>
                        <input type="text" class="form-control @error('materia') is-invalid @enderror" name="materia"
                            autocomplete="off" value="{{ old('materia') }}">

                        @error('materia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nota</label>
                        <input type="number" class="form-control @error('valor') is-invalid @enderror" name="valor"
                            autocomplete="off" value="{{ old('valor') }}">

                        @error('valor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <input type="hidden" name="inscripcion_id" value="{{ $inscripcion->id }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
