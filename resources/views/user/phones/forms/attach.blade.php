<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Adding a new phone') }}
    </x-slot>

    <x-slot name="content">
        {{ Breadcrumbs::render('user.phones.attach') }}

        @include('user.inc.attach-phone')
    </x-slot>
</x-dashboard-layout>