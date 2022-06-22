@props(['label', 'text' => $label, 'type' => 'text', 'val', 'class' => 'col-lg-6'])

<div class="row">
    <div class="form-group {{ $class }}">
        <label>{{ ucfirst($text) }}</label>
        <input type={{ $type }} class="form-control @error($label) is-invalid @enderror"
            name="{{ $label }}" autocomplete="off" value="{{ old($label, $val) }}" autofocus>

        @error($label)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
