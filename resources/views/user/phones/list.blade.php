<x-dashboard-layout>
    <x-slot name="title">
        {{ __('My phones') }}
    </x-slot>

    <x-slot name="content">

        @if ($currentUser->phones()->count())
            @foreach ($currentUser->phones() as $phone)
                <div class="user-phone mb-3">
                    {{ $phone->number }}
                </div>
            @endforeach
        @else
            <div class="alert alert-info">{{ __('You need validate your phone before continue') }}</div>
            @include('user.inc.attach-phone-btn')
        @endif

    </x-slot>
</x-dashboard-layout>