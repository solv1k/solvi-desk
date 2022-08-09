<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Edit advert') }} #{{ $advert->id }}
    </x-slot>
    
    <x-slot name="content">
        <form action="{{ route('admin.adverts.update', $advert->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="advert_category_id">{{ __('Advert category') }}:</label>
                <select
                    id="advert_category_id"
                    name="advert_category_id"
                    class="form-control"
                >
                    @forelse ($advert_categories as $category)
                        <option value="{{ $category->id }}" @selected(old('advert_category_id', $advert->advert_category_id) === $category->id)>
                            {{ $category->title }}
                        </option>
                    @empty
                        <option>{{ __('Advert categories not found') }}</option>
                    @endforelse
                </select>
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
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> {{ __('Save changes') }}</button>
                <a href="{{ route('admin.adverts.view', $advert->id) }}" class="btn btn-primary"><i class="bi bi-eye"></i> {{ __('View') }}</a>
            </div>

        </form>
    </x-slot>
</x-dashboard-layout>