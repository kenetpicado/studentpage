@props(['grupos', 'old' => '', 'text' => 'Selecionar grupo'])

<div class="mb-3">
    <label class="form-label">{{ $text }}</label>
    <select name="grupo_id" class="form-control @error('grupo_id') is-invalid @enderror">
        <option selected disabled value="">Seleccionar</option>
        @foreach ($grupos as $grupo)
            <option value="{{ $grupo->id }}"
                {{ old('grupo_id') == $grupo->id || $grupo->id == $old ? 'selected' : '' }}>
                {{ $grupo->curso_nombre }} -
                {{ $grupo->horario }} -
                {{ $grupo->docente_nombre }}
            </option>
        @endforeach
    </select>

    @error('grupo_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label small text-primary">Asegúrese de seleccionar el grupo correcto.</label>
</div>
