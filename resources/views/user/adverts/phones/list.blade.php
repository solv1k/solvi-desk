<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Attach phone to advert') }}
    </x-slot>
    <x-slot name="content">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($currentUser->phones()->count())
            <form action="{{ route('user.adverts.phones.attach', $advert->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="user_phone_id">
                        {{ __('Select phone for main advert contact or') }} 
                        <a href="{{ route('user.phones.attach') }}">{{ __('adding new phone') }}</a>:
                    </label>
                    <select
                        id="user_phone_id"
                        name="user_phone_id"
                        class="form-control">
                        @foreach ($currentUser->phones as $phone)
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
                        class="form-control">
                </div>

                <div class="mb-3">
                    <button 
                        type="submit" 
                        class="btn btn-success"
                    >{{ __('Next step') }} <i class="bi bi-arrow-right-circle"></i></button>
                </div>
            </form>
        @else
            @include('user.inc.attach-phone')
        @endif

    </x-slot>
</x-dashboard-layout>