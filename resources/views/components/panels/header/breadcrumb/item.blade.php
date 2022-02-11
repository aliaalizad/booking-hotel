@if ($muted)
    <li class="breadcrumb-item text-muted pe-3">{{ $name }}</li>
@else
    <li class="breadcrumb-item pe-3"><a href='{{ route("$route") }}' class="pe-3">{{ $name }}</a></li>
@endif

