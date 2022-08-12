<div class="p-3 border-bottom">
    <div class="d-flex flex-wrap align-items-center gap-3 row">
        <div class="col" style="max-width: 30px;">
            <span class="text-muted">#{{ $advert->id }}</span>
        </div>
        <div class="col" style="max-width: 100px;">
            <img src="{{ $advert->main_image_url }}" alt="#{{ $advert->id }}" class="img-fluid">
        </div>
        <div class="col-md-3">
            {{ $advert->title }}
        </div>
        <div class="col-md-6">
            @include('admin.inc.advert-links', compact('advert'))
        </div>
    </div>
</div>