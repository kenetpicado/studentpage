@props(['label' => $name, 'name', 'type' => 'text', 'val' => '', 'class' => ''])

<div class="mb-3 {{ $class }}">
    <label class="form-label">{{ ucfirst($label) }}</label>
    <input type={{ $type }} value='{{ old($name, $val) }}'
        class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" autofocus>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
