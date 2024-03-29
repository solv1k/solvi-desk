<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Linking a phone number') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('user.adverts.phones.attach', $advert) }}

        <div class="mb-4 pb-4 border-bottom">
            <div class="fw-bold fs-5">
                {{ $advert->title }}
            </div>
        </div>

        @if ($current_user->verifiedPhones()->count())
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
                        @foreach ($current_user->verifiedPhones as $phone)
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

        @include('user.phones.inc.unverified-phones-list')

        @if ($current_user->phones()->count() === 0)
            @include('user.adverts.inc.attach-phone')
        @endif

    </x-slot>
</x-dashboard-layout>