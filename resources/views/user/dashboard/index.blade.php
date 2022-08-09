<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>
    <x-slot name="content">
        {{ __('Welcome') }}, {{ $currentUser->name }}

        @if ($adverts_count)
            <div class="my-3">
                <a href="{{ route('user.adverts.list') }}">{{ __('My adverts') }} ({{ $adverts_count }})</a>
            </div>
        @endif

        @include('user.inc.create-advert-link')
    </x-slot>
</x-dashboard-layout>
