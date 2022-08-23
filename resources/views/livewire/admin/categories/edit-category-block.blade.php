<div>
    @if ($step === 'init')

        <h3>{{ $category->title }}</h3>

        <div class="text-muted mb-4">
            {{ $category->description }}
        </div>

        <button 
            wire:click="edit" 
            class="btn btn-primary btn-sm"
            >{{ __('Edit category') }}</button>

    @elseif ($step === 'edit')

        <form wire:submit.prevent="submit">
            <div class="mb-3">
                <input wire:model="category.title" type="text" class="form-control">
                @error('category.title') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <input wire:model="category.description" type="text" class="form-control">
                @error('category.description') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button
                class="btn-save-category btn btn-primary"
                >{{ __('Save category') }}</button>
        </form>

    @endif
</div>
