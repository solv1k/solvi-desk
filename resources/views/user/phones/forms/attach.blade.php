<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Adding a new phone') }}
    </x-slot>

    <x-slot name="content">

        {{ Breadcrumbs::render('user.phones.attach') }}

        @include('user.adverts.inc.attach-phone')

        @include('user.phones.inc.unverified-phones-list')
        
    </x-slot>
</x-dashboard-layout>