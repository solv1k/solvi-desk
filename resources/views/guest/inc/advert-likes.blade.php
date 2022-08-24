@auth
    @livewire('user.adverts.like-button', compact('advert'))
@else
    @livewire('guest.adverts.like-button', compact('advert'))
@endauth