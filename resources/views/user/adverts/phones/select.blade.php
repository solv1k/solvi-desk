<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Linking a phone number') }}
    </x-slot>
    <x-slot name="content">
        <div class="mb-4 pb-4 border-bottom">
            <div class="fw-bold fs-5">
                {{ $advert->title }}
            </div>
        </div>

        @if ($currentUser->verifiedPhones()->count())
            @include('inc.form-errors')

            <form action="{{ route('user.adverts.phones.attach', $advert->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="user_phone_id">
                        {{ __('Select phone for main advert contact or') }} 
                        <a href="{{ route('user.phones.attach') }}">{{ __('add new phone') }}</a>:
                    </label>
                    <select
                        id="user_phone_id"
                        name="user_phone_id"
                        class="form-control">
                        @foreach ($currentUser->verifiedPhones as $phone)
                            <option value="{{ $phone->id }}" @selected(old('user_phone_id') === $phone->id)>
                                {{ $phone->number }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="contact_name">{{ __('Contact name') }}</label>
                    <input 
                        type="text"
                        id="contact_name"
                        name="contact_name"
                        placeholder="{{ __('Write contact name') }}"
                        value="{{ old('contact_name', $advert->contact_name) }}"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <button 
                        type="submit" 
                        class="btn btn-success"
                    >{{ __('Next step') }} <i class="bi bi-arrow-right-circle"></i></button>
                </div>
            </form>
        @endif

        @if ($currentUser->unverifiedPhones()->count())
            <div class="mb-3">
                <div class="mb-3">{{ __('You have unverified numbers.') }}</div>

                @foreach ($currentUser->unverifiedPhones as $phone)
                    <div class="user-phone mb-3">
                        <span class="user-phone--number">{{ $phone->number }}</span>
                        <span class="user-phone--verification-label text-muted small">{{ $phone->verifiedLabel() }}</span>
                        <a href="{{ route('user.phones.verify.page', $phone->id) }}">{{ __('verify this phone') }}</a>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($currentUser->phones()->count() === 0)
            @include('user.inc.attach-phone')
        @endif

    </x-slot>
</x-dashboard-layout>