<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Adding new phone') }}
    </x-slot>

    <x-slot name="content">
        @include('user.inc.attach-phone')
    </x-slot>
</x-dashboard-layout>