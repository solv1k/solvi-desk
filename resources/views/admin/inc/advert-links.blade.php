<div class="d-flex flex-wrap gap-2">
    <a href="{{ route('admin.adverts.view', $advert->id) }}"><i class="bi bi-eye"></i> {{ __('View') }}</a>
    <a href="{{ route('admin.adverts.edit', $advert->id) }}"><i class="bi bi-pencil-square"></i> {{ __('Edit') }}</a>
</div>