<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>
    <x-slot name="content">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i> {{ $message }}
            </div>
        @endif

        @if ($advertsCount)
            <div class="my-3">
                <a href="{{ route('user.adverts.list') }}">{{ __('My adverts') }} ({{ $advertsCount }})</a>
            </div>
        @endif

        @if ($likedAdverts_count)
            <div class="my-3">
                <a href="{{ route('user.adverts.liked') }}">{{ __('Liked adverts') }} ({{ $likedAdverts_count }})</a>
            </div>
        @endif

        @include('user.adverts.inc.create-advert-link')
    </x-slot>
</x-dashboard-layout>
