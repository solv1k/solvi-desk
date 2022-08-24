<div class="advert-row p-3 border-bottom">
    <div class="d-flex flex-wrap align-items-center gap-3 row">
        <div class="col" style="max-width: 30px;">
            <span class="text-muted">#{{ $advert->id }}</span>
        </div>
        <div class="col" style="max-width: 100px;">
            <img src="{{ $advert->main_image_url }}" alt="#{{ $advert->id }}" class="img-fluid">
        </div>
        <div class="col-md-3">
            {{ $advert->title }}
            <span class="text-muted"> / {{ $advert->category->title }}</span>
            <div class="div">
                <a href="{{ route('admin.adverts.view', $advert->id) }}"><i class="bi bi-eye"></i> {{ __('View') }}</a>
                <a href="{{ route('admin.adverts.edit', $advert->id) }}" class="ml-2"><i class="bi bi-pencil-square"></i> {{ __('Edit') }}</a>
            </div>
        </div>
        <div class="col-md-6">
            @include('admin.inc.advert-links', compact('advert'))
        </div>
    </div>
</div>
