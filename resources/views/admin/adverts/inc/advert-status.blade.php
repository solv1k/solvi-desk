<div class="text-muted small">
    @if (! $advert->phone_number)
        <div class="advert--status-label">{{ $advert->status_label }}</div>
        <a href="{{ route('user.adverts.phones.list', $advert->id) }}">{{ __('attach phone') }}</a>
    @else
        <div class="advert--status-label">{{ $advert->status_label }}</div>
        <div class="advert--contact-name">{{ $advert->contact_name }}</div>
        <div class="advert--phone"><i class="bi bi-telephone"></i> {{ $advert->phone_number }}</div>
    @endif
</div>