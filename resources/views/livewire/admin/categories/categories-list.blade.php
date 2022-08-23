<div>
    @empty($categories)
        <div class="alert alert-info">{{ __('Categories was not found...') }}</div>
    @else
        <div class="mb-3">
            {!! view_full_tree($categories, 'admin.categories.inc.category-tree-item', '---') !!}
        </div>
    @endempty
</div>
