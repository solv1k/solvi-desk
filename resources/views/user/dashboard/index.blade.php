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

        @if ($adverts_count)
            <div class="my-3">
                <a href="{{ route('user.adverts.list') }}">{{ __('My adverts') }} ({{ $adverts_count }})</a>
            </div>
        @endif

        @if ($liked_adverts_count)
            <div class="my-3">
                <a href="{{ route('user.adverts.liked') }}">{{ __('Liked adverts') }} ({{ $liked_adverts_count }})</a>
            </div>
        @endif

        @include('user.inc.create-advert-link')
    </x-slot>
</x-dashboard-layout>
