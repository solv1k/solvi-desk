<div class="d-flex flex-wrap gap-2 align-items-center">
    <a href="{{ route('admin.adverts.view', $advert->id) }}"><i class="bi bi-eye"></i> {{ __('View') }}</a>
    <a href="{{ route('admin.adverts.edit', $advert->id) }}"><i class="bi bi-pencil-square"></i> {{ __('Edit') }}</a>
    @if ($advert->isWaitModeration())
        <a href="{{ route('admin.adverts.activate', $advert->id) }}" class="btn btn-primary btn-sm">{{ __('Activate advert') }}</a>
    @else
        <a href="{{ route('admin.adverts.to-moderation', $advert->id) }}" class="btn btn-warning btn-sm">{{ __('Send to moderation') }}</a>
    @endif
</div>