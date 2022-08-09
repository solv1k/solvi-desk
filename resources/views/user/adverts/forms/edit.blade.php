<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Create new advert') }}
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

        <form action="{{ route('user.adverts.update', $advert->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="advert_category_id">{{ __('Select advert category') }}:</label>
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
                    id="title" 
                    name="title" 
                    type="text" 
                    class="form-control" 
                    required
                    placeholder="{{ __('Advert title') }}"
                    value="{{ old('title', $advert->title) }}">
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
                    value="{{ old('price', $advert->price) }}">
            </div>

            <div class="mb-3">
                <label for="description">{{ __('Advert description') }}</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    rows="6"
                    placeholder="{{ __('Advert description') }}"
                >{{ old('description', $advert->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label>{{ __('Main advert image') }}</label>
                <img src="{{ $advert->main_image_url }}" alt="#{{ $advert->id }}" style="max-width: 180px;">
            </div>

            <div class="mb-3">
                <input
                    id="image"
                    name="image"
                    type="file"
                    placeholder="{{ __('Select advert image') }}">
            </div>

            <div class="mb-3">
                <button 
                    type="submit" 
                    class="btn btn-success"
                >{{ __('Next step') }} <i class="bi bi-arrow-right-circle"></i></button>
            </div>
        </form>
    </x-slot>

    @push('scripts')
        <script type="module" defer>
            FilePond.parse(document.body);
        </script>    
    @endpush
</x-dashboard-layout>