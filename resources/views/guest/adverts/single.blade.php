<x-guest-layout>
    <x-slot name="content">

        <div class="advert-page">
            <div class="advert d-flex gap-4 flex-column flex-md-row">
                <div class="advert--image">
                    <img src="{{ $advert->main_image_url }}" alt="{{ $advert->title }}" class="img-fluid" style="max-width: 320px;">
                </div>
                <div class="advert--info">
                    <div class="advert--title fs-4">
                        {{ $advert->title }} 
                    </div>

                    <div class="advert--category text-muted mb-3">
                        {{ __('Category') }}: {{ $advert->category?->title }}
                    </div>

                    <div class="advert--price fs-3 fw-bold">
                        {{ price_format($advert->price) }} {{ GeneralSetting::getValue('currency_symbol') }}
                    </div>

                    <div class="advert--owner mb-4">
                        @include('guest.inc.advert-owner', compact('advert'))
                    </div>

                    <div class="advert--description">
                        {!! $advert->description !!}
                    </div>
                    
                    @can('update', $advert)
                        <div class="advert--controls my-3">
                            <a class="btn btn-primary" href="{{ route('user.adverts.edit', $advert->id) }}"><i class="bi bi-pencil-square"></i> {{ __('Edit advert') }}</a>
                        </div>
                    @endcan

                    <div class="advert--stats d-flex gap-2 align-items-center">
                        @include('guest.inc.advert-likes', compact('advert'))
                        @include('guest.inc.advert-views', compact('advert'))
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-guest-layout>
