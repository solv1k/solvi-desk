<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Advert categories management') }}
    </x-slot>
    <x-slot name="content">

        <!-- Admin categories list -->
        @livewire('admin.categories.categories-list')

        <!-- Category creator block -->
        @livewire('admin.categories.add-category-block')
    
    </x-slot>
</x-dashboard-layout>