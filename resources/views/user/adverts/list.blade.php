<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Advert list') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('user.adverts.list') }}

        <div class="adverts-list row">
            @forelse ($adverts as $advert)
                <div class="col-md-6 col-lg-4 mb-4">
                    @include('user.adverts.inc.advert', compact('advert'))
                </div>
            @empty
                <div class="alert alert-info">{{ __('Advert list is empty...') }}</div>
            @endforelse
        </div>

        @include('user.adverts.inc.create-advert-link')
    </x-slot>
</x-dashboard-layout>
