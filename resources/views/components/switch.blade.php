@props(['key', 'adm', 'deny', 'label' => ''])

<div class="form-check form-switch">
    <input type="hidden" name="{{ $deny }}[{{ $key }}]" value="{{ $deny }}">
    <input class="form-check-input" type="checkbox" role="switch" name="{{ $deny }}[{{ $key }}]"
        value="0" {{ !$adm->permisos->contains('denegar', $deny) ? 'checked' : '' }}>
    <label class="form-check-label">{{ $label }}</label>
</div>
