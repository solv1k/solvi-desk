@php
    $category = $node;
@endphp

<div>
    {{ $prefix }}
    
    <a href="{{ route('admin.categories.view', $category->id) }}">
        {{ $category->title }}
    </a>
</div>