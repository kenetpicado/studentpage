@props(['route', 'text', 'when'])

<li @class(['nav-item mx-2', 'border-2 border-bottom border-primary' => request()->is($when . '*') ])>
    <a aria-current="page" href={{ route($route) }} @class(['nav-link ', 'active' => request()->is($when . '*')])>{{ $text }}</a>
</li>
