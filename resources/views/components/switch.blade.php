@props(['name', 'key', 'adm'])

<td class="text-center">
    <input type="hidden" name="permitir_{{ $name }}[{{ $key }}]" value="0">

    @if ($adm->permisos->contains('denegar', 'create_' . $name))
        <div class="form-switch">
            <input class="form-check-input" type="checkbox" role="switch"
                name="permitir_{{ $name }}[{{ $key }}]" value="1">
        </div>
    @else
        <div class="form-switch">
            <input class="form-check-input" type="checkbox" role="switch"
                name="permitir_{{ $name }}[{{ $key }}]" value="1" checked>
        </div>
    @endif
</td>
