<div class="d-flex flex-wrap gap-2 align-items-center">
    @if ($advert->isWaitModeration())
        <a href="{{ route('admin.adverts.activate', $advert->id) }}" class="btn btn-primary btn-sm">{{ __('Activate advert') }}</a>
    @else
        <a href="{{ route('admin.adverts.to-moderation', $advert->id) }}" class="btn btn-warning btn-sm">{{ __('Send to moderation') }}</a>
    @endif
</div>
