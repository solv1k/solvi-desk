<div>
    @if ($step === 'init')
        <button
            wire:click="start"
            class="btn-add-new-category btn btn-primary"
            >{{ __('Add new category') }}</button>
    @endif

    @if ($step === 'creating')
    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <label for="">{{ __('Order') }}</label>
            <input wire:model="order" type="number" step="1" class="form-control" placeholder="{{ __('0') }}">
            @error('order') <span class="error">{{ $message }}</span> @enderror
        </div>

        @if ($categories)
            <div class="mb-3">
                <label for="">{{ __('Parent category') }}</label>
                <select wire:model="parent_category_id" class="form-control">
                    <option value="" @selected(old('parent_category_id') === null)>{{ __('Select one...') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                @error('parent_category_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        @endif

        <div class="mb-3">
            <label for="">{{ __('Category title') }}</label>
            <input wire:model="title" type="text" class="form-control" placeholder="{{ __('Write category title') }}">
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="">{{ __('Category description') }}</label>
            <textarea wire:model="description" rows="6" class="form-control" placeholder="{{ __('Write category description') }}"></textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button
            class="btn-save-category btn btn-primary"
            >{{ __('Save category') }}</button>
    </form>
    @endif

    @if ($step === 'created')
        <div class="alert alert-success mb-3">{{ __('Category') . untrim($title) . __('was saved successfuly!') }}</div>

        <button
            wire:click="start"
            class="btn-add-new-category btn btn-primary"
            >{{ __('Add new category') }}</button>
    @endif
</div>
