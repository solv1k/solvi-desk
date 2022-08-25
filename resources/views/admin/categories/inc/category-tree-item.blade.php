@php
    $category = $node;
@endphp

<div>
    {{ $prefix }}

    <a href="{{ route('admin.categories.view', $category->id) }}">
        {{ $category->title }} ({{ $category->adverts()->count() + $category->descendants()->withCount('adverts')->get()->sum('adverts_count') }})
    </a>
</div>
