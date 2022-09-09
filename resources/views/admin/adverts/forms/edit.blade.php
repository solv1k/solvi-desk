<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Edit advert') }} #{{ $advert->id }}
    </x-slot>

    <x-slot name="content">
        {{ Breadcrumbs::render('admin.adverts.edit', $advert) }}

        @include('inc.form-errors')

        <form action="{{ route('admin.adverts.update', $advert->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                @livewire('user.adverts.category-selector-block', ['advert' => $advert, 'mode' => 'edit'])
            </div>

            <div class="mb-3">
                <label for="title">{{ __('Advert title') }}</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="{{ __('Advert title') }}"
                    value="{{ old('title', $advert->title) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="price">{{ __('Advert price') }} ({{ GeneralSetting::getValue('currency_symbol') }})</label>
                <input
                    type="text"
                    id="price"
                    name="price"
                    placeholder="{{ __('Advert price') }}"
                    value="{{ old('price', $advert->price) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="description">{{ __('Advert description') }}</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    rows="6"
                    placeholder="{{ __('Advert description') }}"
                >{{ old('description', multitrim(br2nl($advert->description))) }}</textarea>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> {{ __('Save changes') }}</button>
                <a href="{{ route('admin.adverts.view', $advert->id) }}" class="btn btn-primary"><i class="bi bi-eye"></i> {{ __('View') }}</a>
            </div>

        </form>
    </x-slot>
</x-dashboard-layout>
