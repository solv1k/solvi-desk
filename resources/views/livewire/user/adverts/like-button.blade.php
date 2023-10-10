<div>
    <button 
        class="advert--like-btn my-2 text-danger" 
        wire:click="toggle"
        data-bs-toggle="tooltip"
        data-bs-placement="right"
        data-bs-title="{{ __('Like advert') }}">

            @if ($wasLiked)
                <i class="bi bi-heart-fill"></i>
            @else
                <i class="bi bi-heart"></i>
            @endif

            <span class="advert--like-counter">
                {{ $likesCount }}
            </span>

    </button>
</div>
