<div class="advert card">
    <img src="{{ $advert->main_image_url }}" class="advert--main-image card-img-top" alt="{{ $advert->title }}">
    <div class="card-body">
        <h5 class="advert--title card-title">
            <a href="{{ route('user.adverts.view', $advert->id) }}">
                {{ $advert->title }}
            </a>
        </h5>
        
        <p class="advert--description card-text">
            {!! $advert->description !!}
        </p>

        <div class="price fw-bold fs-4">
            {{ price_format($advert->price) }} {{ GeneralSetting::getValue('currency_symbol') }}
        </div>

        @include('user.adverts.inc.advert-status', compact('advert'))

        <div class="advert--stats d-flex gap-2 align-items-center">
            @include('guest.inc.advert-likes', compact('advert'))
            @include('guest.inc.advert-views', compact('advert'))
        </div>
    </div>
</div>