<x-dashboard-layout>
    <x-slot name="title">
        {{ __('My phones') }}
    </x-slot>

    <x-slot name="content">

        @if ($current_user->phones()->count())
            @foreach ($current_user->phones() as $phone)
                <div class="user-phone mb-3">
                    <span class="user-phone--number">{{ $phone->number }}</span>
                    <span class="user-phone--verification-label text-muted small">{{ $phone->verifiedLabel() }}</span>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">{{ __('You need validate your phone before continue') }}</div>
            @include('user.inc.attach-phone-btn')
        @endif

    </x-slot>
</x-dashboard-layout>