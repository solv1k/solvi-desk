<div 
    class="d-inline-block"
    data-bs-toggle="modal"
    data-bs-target="#needSignInModal">

    <button 
        class="advert--like-btn my-2 text-danger"
        data-bs-toggle="tooltip"
        data-bs-placement="right"
        data-bs-title="{{ __('Likes') }}">

            <i class="bi bi-heart"></i>

            <span class="advert--like-counter">
                {{ $likesCount }}
            </span>

    </button>

    <!-- Need Sign In -->
    <div class="modal fade" id="needSignInModal" tabindex="-1" aria-labelledby="needSignInModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="needSignInModalLabel">{{ __('Need authorize') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        {{ __('You can like this advert if you are logged in') }}.
                    </div>

                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="bi bi-arrow-bar-right"></i> {{ __('Log in') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-link"><i class="bi bi-user-add"></i> {{ __('Register') }}</a>
                </div>
            </div>
        </div>
    </div>
  
</div>
