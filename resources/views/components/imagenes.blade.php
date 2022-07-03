@props(['old' => '', 'class' => '', 'imagenes'])

<div class="form-group {{ $class }}">
    <label>Imagen</label>
    <select name="imagen" class="form-control @error('imagen') is-invalid @enderror" autofocus>
        <option selected disabled value="">Seleccionar</option>
        @foreach ($imagenes as $imagen)
            <option value="{{ $imagen['nombre'] }}"
                {{ old('imagen') == $imagen['nombre'] || $imagen['nombre'] == $old ? 'selected' : '' }}>
                {{ $imagen['nombre'] }}
            </option>
        @endforeach
    </select>
    @error('imagen')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
