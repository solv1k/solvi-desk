<div class="mb-3">
    <div class="d-flex flex-wrap align-items-center gap-3">
        <div class="fs-4"><span class="text-muted">#{{ $advert->id }}</span> {{ $advert->title }}</div>
        @include('admin.inc.advert-links', compact('advert'))
    </div>
</div>