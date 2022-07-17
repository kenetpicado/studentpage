@props(['route', 'text', 'when'])

<li class="nav-item mx-2 {{ request()->is($when . '*') ? 'border-2 border-bottom border-primary' : '' }}">
    <a class="nav-link {{ request()->is($when . '*') ? 'active' : '' }}" aria-current="page" href={{ route($route) }}>{{ $text }}</a>
</li>
