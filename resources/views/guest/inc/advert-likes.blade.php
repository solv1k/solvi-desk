@auth
    @if ($current_user->canLikeAdverts())
        @livewire('user.adverts.like-button', compact('advert'))
    @endif
@else
    @livewire('guest.adverts.like-button', compact('advert'))
@endauth