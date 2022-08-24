<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Advert category management') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('admin.categories.view', $category) }}

        <!-- Category editor block -->
        @livewire('admin.categories.edit-category-block', compact('category'))

    </x-slot>
</x-dashboard-layout>
