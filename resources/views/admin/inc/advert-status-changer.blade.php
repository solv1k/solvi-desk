<div class="mb-3 justify-content-between d-md-flex gap-3 align-items-center rounded p-4 bg-warning bg-opacity-25">
    @include('admin.inc.advert-status', compact('advert'))

    <div class="advert--admin-controls my-3">
        @if ($advert->isWaitModeration())
            <a href="{{ route('admin.adverts.activate', $advert->id) }}" class="btn btn-primary btn-sm">{{ __('Activate advert') }}</a>
        @else
            <a href="{{ route('admin.adverts.to-moderation', $advert->id) }}" class="btn btn-warning btn-sm">{{ __('Send to moderation') }}</a>
        @endif
    </div>
</div>