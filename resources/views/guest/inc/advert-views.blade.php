<div class="d-inline-block">
    <span
        role="button"
        data-bs-toggle="tooltip"
        data-bs-placement="right"
        data-bs-title="{{ __('Views') }}"
    >
        <i class="bi bi-eye"></i> 
        
        <span class="advert--views-counter">
            {{ $advert->statTotal?->views ?? 0 }}
        </span>
    </span>
</div>