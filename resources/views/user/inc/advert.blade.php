<div class="advert card" style="width: 18rem;">
    <img src="{{ $advert->main_image_url }}" class="advert--main-image card-img-top" alt="{{ $advert->title }}">
    <div class="card-body">
        <h5 class="advert--title card-title">
            <a href="{{ route('user.adverts.view', $advert->id) }}">
                {{ $advert->title }}
            </a>
        </h5>
        <p class="advert--description card-text">
            {{ $advert->description }}
        </p>
        <div class="price fw-bold fs-4">
            {{ price_format($advert->price) }} {{ GeneralSetting::getValue('currency_symbol') }}
        </div>
        @include('user.inc.advert-status', compact('advert'))
    </div>
</div>