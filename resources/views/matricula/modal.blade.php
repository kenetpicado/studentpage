<!-- Matricula Modal -->
<div class="modal fade" id="agregar" tabindex="1" role="dialog" aria-labelledby="matriculaModalCreate"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Agregar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('matriculas.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nombre">Nombre completo</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                autocomplete="off" value="{{ old('nombre') }}" required autofocus>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="fecha_nac">Fecha de nacimiento</label>
                            <input type="date" class="form-control @error('fecha_nac') is-invalid @enderror"
                                name="fecha_nac" value="{{ old('fecha_nac') }}" required>

                            @error('fecha_nac')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="cedula">Cédula</label>
                            <input maxlength="16" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula"
                                autocomplete="off" value="{{ old('cedula') }}">

                            @error('cedula')
                                <span class="  invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="grado">Último grado aprobado</label>
                            <input type="text" class="form-control @error('grado') is-invalid @enderror" name="grado"
                                autocomplete="off" value="{{ old('grado') }}" required>

                            @error('grado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="tutor">Tutor</label>
                            <input type="text" class="form-control" name="tutor" autocomplete="off"
                                value="{{ old('tutor') }}">
                        </div>
                        <div class="form-group col-6">
                            <label for="tel">Teléfono</label>
                            <input type="number" class="form-control @error('tel') is-invalid @enderror" name="tel"
                                autocomplete="off" value="{{ old('tel') }}">

                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        @if ($user->rol == 'admin')
                            <div class="form-group col-6">
                                <label>Carnet - (Opcional)</label>
                                <input type="text" class="form-control @error('carnet') is-invalid @enderror"
                                    name="carnet" autocomplete="off" value="{{ old('carnet') }}">

                                @error('carnet')
                                    <span class="  invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif

                        @if ($user->sucursal == 'all')
                            <div class="form-group col-6">
                                <label for="sucursal">Sucursal</label>
                                <select name="sucursal" class="form-control @error('sucursal') is-invalid @enderror"
                                    required>
                                    <option selected disabled value="">Seleccionar</option>
                                    <option value="CH" {{ old('sucursal') == 'CH' ? 'selected' : '' }}>CHINANDEGA
                                    </option>
                                    <option value="MG" {{ old('sucursal') == 'MG' ? 'selected' : '' }}>MANAGUA
                                    </option>
                                </select>

                                @error('sucursal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif
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
