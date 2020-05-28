@if (! empty($breadcrumbs))
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    @foreach ($breadcrumbs as $label => $link)
    @if (is_int($label) && ! is_int($link))
    <li class="breadcrumb-item active">{{ $link }}</li>
    @else
    <li class="breadcrumb-item"><a href="{{ $link }}">{{ $label }}</a></li>
    @endif
    @endforeach
</ol>
@endif
