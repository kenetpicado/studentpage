@props(['text'])

<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">{{ $text }}{{ $slot }}</h6>
</div>
