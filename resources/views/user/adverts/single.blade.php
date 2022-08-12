<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Advert page') }}
    </x-slot>
    <x-slot name="content">

        <div class="advert-page">
            <div class="advert d-flex gap-4 flex-column flex-md-row">
                <div class="advert--image">
                    <img src="{{ $advert->main_image_url }}" alt="{{ $advert->title }}" width="240">
                </div>
                <div class="advert--info">
                    <div class="advert--title fs-4">
                        {{ $advert->title }} 
                    </div>
                    <div class="advert--category text-muted mb-3">
                        Категория: {{ $advert->category?->title }}
                    </div>
                    <div class="advert--status">
                        @include('user.inc.advert-status', compact('advert'))
                    </div>
                    <div class="advert--price fs-3 fw-bold mb-4">
                        {{ price_format($advert->price) }} {{ GeneralSetting::getValue('currency_symbol') }}
                    </div>
                    <div class="advert--description">
                        {!! $advert->description !!}
                    </div>
                    @can('update', $advert)
                        <div class="advert--controls my-3">
                            <a 
                                class="btn btn-primary" 
                                href="{{ route('user.adverts.edit', $advert->id) }}">
                            <i class="bi bi-pencil-square"></i> {{ __('Edit advert') }}</a>
                            <a 
                                class="btn btn-warning" 
                                href="{{ route('user.adverts.phones.list', $advert->id) }}">
                            <i class="bi bi-telephone"></i> {{ __('Change phone') }}</a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>

    </x-slot>
</x-dashboard-layout>
