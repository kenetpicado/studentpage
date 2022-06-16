@props(['class' => ''])

<div class="form-group {{ $class }}">
    <label for="sucursal">Sucursal</label>
    <select name="sucursal" class="form-control @error('sucursal') is-invalid @enderror" required>
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
