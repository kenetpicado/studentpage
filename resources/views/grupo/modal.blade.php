<!-- Grupos Modal -->
<div class="modal fade" id="grupoModalCreate" tabindex="-1" role="dialog" aria-labelledby="grupoModalCreate"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">AGREGAR UN NUEVO GRUPO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="" action="{{ route('grupo.store') }}" method="POST">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="curso_id">Curso</label>
                    <select name="curso_id" class="form-control @error('curso_id') is-invalid @enderror">
                        <option selected disabled value="">Seleccionar</option>
                        @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}"
                                {{ old('curso_id') == $curso->id ? 'selected' : '' }}>{{ $curso->id }} -
                                {{ $curso->nombre }}</option>
                        @endforeach
                    </select>

                    @error('curso_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="docente_id">Docente</label>
                    <select name="docente_id" class="form-control @error('docente_id') is-invalid @enderror">
                        <option selected disabled value="">Seleccionar</option>
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}"
                                {{ old('docente_id') == $docente->id ? 'selected' : '' }}>{{ $docente->id }}
                                - {{ $docente->nombre }}</option>
                        @endforeach
                    </select>
                    @error('docente_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="numero">Número</label>
                    <select name="numero" class="form-control @error('numero') is-invalid @enderror">
                        <option disabled selected value="">Seleccionar</option>
                        @for ($i = 1; $i < 5; $i++)
                            <option value="GP{{ $i }}"
                                {{ old('numero') == 'GP' . $i ? 'selected' : '' }}>GP{{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('numero')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
</div>