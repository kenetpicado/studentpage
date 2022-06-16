@props(['val'])

<div class="form-check">
    <input class="form-check-input" type="checkbox" name="activo" value="1"
        {{ !old() && $val || old('activo') == '1' ? 'checked' : '' }}>
    <label>Activo</label>
</div>
