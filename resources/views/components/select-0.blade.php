@props(['label', 'class' => 'col-lg-6', 'text' => $label, 'items', 'old' => ''])

<div class="form-group {{ $class }}">
    <label>{{ ucfirst($text) }}</label>

    <select name="{{ $label }}" class="form-control @error($label) is-invalid @enderror" autofocus>

        <option selected disabled value="">Seleccionar</option>

        @foreach ($items as $item)
            <option value="{{ $item->id }}"
                {{ old($label) == $item->id || $old == $item->id ? 'selected' : '' }}>
                {{ $item->nombre }}
            </option>
        @endforeach

    </select>

    @error($label)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
