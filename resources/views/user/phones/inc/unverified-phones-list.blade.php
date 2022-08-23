@if ($currentUser->unverifiedPhones()->count())
<div class="mb-3">
    <div class="mb-3">{{ __('You have unverified numbers.') }}</div>

    @foreach ($currentUser->unverifiedPhones as $phone)
        <div class="user-phone mb-3">
            <span class="user-phone--number">{{ $phone->number }}</span>
            <a href="{{ route('user.phones.verify.page', $phone->id) }}">{{ __('verify this phone') }}</a>
            <a href="{{ route('user.phones.verify.cancel', $phone->id) }}" class="text-danger">{{ __('cancel') }}</a>
        </div>
    @endforeach
</div>
@endif