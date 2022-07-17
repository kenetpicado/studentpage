@props(['modal', 'text'])
<li>
    <a class="dropdown-item" href="#" data-bs-toggle="modal"
        data-bs-target="#{{ $modal }}">{{ $text }}</a>
</li>
