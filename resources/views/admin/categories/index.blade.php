<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Advert categories management') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('admin.categories.index') }}

        <!-- Admin categories list -->
        <h4 class="mb-2">{{ __('Tree of categories') }}</h4>
        @livewire('admin.categories.categories-list')

        <!-- Category creator block -->
        @livewire('admin.categories.add-category-block')

    </x-slot>
</x-dashboard-layout>
