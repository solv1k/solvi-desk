<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Create new advert') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('user.adverts.create') }}

        @include('inc.form-errors')

        <form action="{{ route('user.adverts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                @livewire('user.adverts.category-selector-block', ['mode' => 'create'])
            </div>

            <div class="mb-3">
                <label for="title">{{ __('Advert title') }}</label>
                <input
                    id="title"
                    name="title"
                    type="text"
                    class="form-control"
                    required
                    placeholder="{{ __('Advert title') }}"
                    value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="price">{{ __('Advert price') }} ({{ GeneralSetting::getValue('currency_symbol') }})</label>
                <input
                    id="price"
                    name="price"
                    type="text"
                    class="form-control"
                    required
                    placeholder="{{ __('Advert price') }}"
                    value="{{ old('price') }}">
            </div>

            <div class="mb-3">
                <label for="description">{{ __('Advert description') }}</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    rows="6"
                    placeholder="{{ __('Advert description') }}"
                >{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label>{{ __('Main advert image') }}</label>
                @include('user.inc.advert-filepond')
            </div>

            <div class="mb-3">
                <button
                    type="submit"
                    class="btn btn-success"
                >{{ __('Next step') }} <i class="bi bi-arrow-right-circle"></i></button>
            </div>

        </form>
    </x-slot>
</x-dashboard-layout>
