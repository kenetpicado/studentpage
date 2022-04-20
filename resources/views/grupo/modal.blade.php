<!-- Agregar -->
<div class="modal fade" id="grupoModalCreate" tabindex="-1" role="dialog" aria-labelledby="grupoModalCreate"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">CREAR GRUPO</h5>
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
                                    {{ old('curso_id') == $curso->id ? 'selected' : '' }}>{{ $curso->nombre }}
                                </option>
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
                                    {{ old('docente_id') == $docente->id ? 'selected' : '' }}>
                                    {{ $docente->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('docente_id')
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

                    <div class="form-group">
                        <label for="horario">Horario</label>
                        <input type="text" class="form-control @error('horario') is-invalid @enderror" name="horario"
                            autocomplete="off" value="{{ old('horario') }}">
                        @error('horario')
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
