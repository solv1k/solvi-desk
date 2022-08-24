<div>
    <div class="mb-4">
        @if ($step === 'init')

            <h3 class="d-flex justify-content-between">
                <span>{{ $category->title }}</span>
                @if ($category->adverts()->exists())
                    <span class="small text-muted" data-bs-toggle="tooltip" data-bs-title="{{ __('Total adverts count') }}">
                        <i class="bi bi-card-list"></i>
                        {{ $category->adverts()->count() }}
                    </span>
                @endif
            </h3>

            <div class="text-muted mb-4">
                {{ $category->description }}
            </div>

            <button wire:click="edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i>
                {{ __('Edit category') }}</button>


            @if ($show_delete_confirm)
                <button wire:click="hideDeleteConfirm" class="ml-4 btn btn-secondary btn-sm">
                    {{ __('Cancel action') }}</button>

                <button wire:click="delete" class="ml-4 btn btn-danger btn-sm"><i class="bi bi-trash"></i>
                    {{ __('Confirm') }}</button>
            @else
                <button wire:click="showDeleteConfirm" class="ml-4 btn btn-link text-danger btn-sm"><i class="bi bi-trash"></i>
                    {{ __('Delete category') }}</button>
            @endif

        @elseif ($step === 'edit')

            <form wire:submit.prevent="submit">
                <div class="mb-3">
                    <label for="">{{ __('Category title') }}</label>
                    <input wire:model="category.title" type="text" class="form-control">
                    @error('category.title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">{{ __('Category description') }}</label>
                    <input wire:model="category.description" type="text" class="form-control">
                    @error('category.description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn-save-category btn btn-primary"><i class="bi bi-save"></i>
                    {{ __('Save changes') }}</button>

                <button type="button" wire:click="cancelEdit"
                    class="btn-save-category btn btn-secondary">{{ __('Cancel edit') }}</button>
            </form>

        @endif
    </div>
</div>
