<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Advert list') }}
    </x-slot>
    <x-slot name="content">

        <div class="adverts-list d-flex flex-wrap gap-4">
            @forelse ($adverts as $advert)
                @include('user.inc.advert', compact('advert'))
            @empty
                <div class="alert alert-info">{{ __('Advert list is empty...') }}</div>
            @endforelse
        </div>

        @include('user.inc.create-advert-link')
    </x-slot>
</x-dashboard-layout>
