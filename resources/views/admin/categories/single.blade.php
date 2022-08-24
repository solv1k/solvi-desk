<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Advert category management') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('admin.categories.view', $category) }}

        <!-- Category editor block -->
        @livewire('admin.categories.edit-category-block', compact('category'))

        <!-- Category properties editor block -->
        @livewire('admin.categories.edit-category-properties-block', compact('category'))

        <hr>

        <h5 class="fw-bold">{{ __('Adverts in category') }}</h5>

        @forelse ($category_adverts as $advert)

            @if ($loop->first)
                <div class="category--adverts-list">
            @endif

            @include('admin.inc.advert-row', compact('advert'))

            @if ($loop->last)
                </div>
                {{ $category_adverts->links() }}
            @endif

        @empty
            <div class="alert alert-info">{{ __('Advert list is empty...') }}</div>
        @endforelse

    </x-slot>
</x-dashboard-layout>
