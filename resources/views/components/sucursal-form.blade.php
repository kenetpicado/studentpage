@props(['class' => ''])

<div class="mb-3 {{ $class }}">
    <label class="form-label">Sucursal</label>
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
