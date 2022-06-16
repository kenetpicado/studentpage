@props(['val', 'y' => 'Activo', 'n' => 'Inactivo'])

@if ($val > '0')
    {{ $y }} <i class="fas fa-check-circle text-primary"></i>
@else
    {{ $n }} <i class="fas fa-exclamation-circle text-danger"></i>
@endif
