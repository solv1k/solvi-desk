<div class="advert advert-home d-lg-flex gap-3 my-4 w-md-50">
    <img 
        src="{{ $advert->main_image_url }}" 
        class="advert--main-image img-fluid card-img-top align-self-start" 
        style="max-width: 240px"
        alt="{{ $advert->title }}">

    <div class="card-body">
        <h5 class="advert--title card-title">
            <a href="{{ route('guest.adverts.view', $advert->id) }}">
                {{ $advert->title }}
            </a>
        </h5>

        <p class="advert--description card-text">
            {{ $advert->description }}
        </p>

        <div class="price fw-bold fs-4">
            {{ price_format($advert->price) }} {{ GeneralSetting::getValue('currency_symbol') }}
        </div>

        <div class="advert--owner small text-muted">
            @include('guest.inc.advert-owner', compact('advert'))
        </div>
    </div>
</div>