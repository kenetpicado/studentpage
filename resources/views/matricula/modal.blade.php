<!-- Matricula Modal -->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="matriculaModalCreate"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">AGREGAR NUEVA MATRICULA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('matricula.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nombre">Nombre completo</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                autocomplete="off" value="{{ old('nombre') }}">

                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="cedula">Cédula</label>
                            <input type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula"
                                autocomplete="off" value="{{ old('cedula') }}" placeholder="000-000000-00000">

                            @error('cedula')
                                <span class="  invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="fecha_nac">Fecha de nacimiento</label>
                            <input type="date" class="form-control @error('fecha_nac') is-invalid @enderror"
                                name="fecha_nac" value="{{ old('fecha_nac', '2000-01-01') }}">

                            @error('fecha_nac')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="tel">Teléfono</label>
                            <input type="number" class="form-control @error('tel') is-invalid @enderror" name="tel"
                                autocomplete="off" value="{{ old('tel') }}" placeholder="00000000">

                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="madre">Nombre de la Madre</label>
                            <input type="text" class="form-control" name="madre" autocomplete="off"
                                value="{{ old('madre') }}">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="padre">Nombre del Padre</label>
                            <input type="text" class="form-control" name="padre" autocomplete="off"
                                value="{{ old('padre') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="grado">Último grado aprobado</label>
                            <input type="text" class="form-control @error('grado') is-invalid @enderror" name="grado"
                                autocomplete="off" value="{{ old('grado') }}">

                            @error('grado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @if (Auth::user()->sucursal == 'all')
                            <div class="form-group col-lg-6">
                                <label for="sucursal">Sucursal</label>
                                <select name="sucursal" class="form-control @error('sucursal') is-invalid @enderror">
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

                    {{-- <div class="form-group col-lg-6">
                            <label for="grupo_id">Seleccionar curso y grupo</label>
                            <select name="grupo_id" class="form-control @error('grupo_id') is-invalid @enderror">
                                <option selected disabled value="">Seleccionar</option>
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->curso->nombre }} -
                                        {{ $grupo->numero }}</option>
                                @endforeach
                            </select>

                            @error('grupo_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
