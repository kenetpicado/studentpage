@props(['name', 'class' => 'col-lg-6', 'text' => $name, 'items', 'old' => ''])

<div class="mb-3">
    <label class="form-label">{{ ucfirst($text) }}</label>
    <select name="{{ $name }}" class="form-control @error($name) is-invalid @enderror" autofocus>

        <option selected disabled value="">Seleccionar</option>

        @foreach ($items as $item)
            <option value="{{ $item->id }}"
                {{ old($name) == $item->id || $old == $item->id ? 'selected' : '' }}>
                {{ $item->nombre }}
            </option>
        @endforeach

    </select>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
