@props(['search'])

<div class="card-body">
    @isset($search)
        <form class="col-6 col-sm-2 mb-3" method="POST" action="{{ route($search) }}">
            @csrf
            <div class="input-group input-group-sm">
                <input type="search" class="form-control" name="search" placeholder="Buscar">
                <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
            </div>
        </form>
    @endisset
    <table class="table table-borderless" id="no-more-tables" width="100%" cellspacing="0">
        <thead>
            <tr>
                {{ $title }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
    <div class="float-end small">
        {{ $links }}
    </div>
</div>
