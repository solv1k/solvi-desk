<div>
    <div class="advert-category--properties mb-3">
        @forelse ($category->properties as $property)
            <div class="advert-category--property">
                {{ $property->title }}

                <button
                    wire:click="edit({{ $property->id }})"
                    type="button"
                    class="btn btn-link btn-sm"><i class="bi bi-pencil"></i>
                </button>

                @if ($show_delete_button && $editable_property_id === $property->id)
                    <button
                        wire:click="delete({{ $property->id }})"
                        type="button"
                        class="btn btn-secondary btn-sm">{{ __('Cancel') }}</i>
                    </button>

                    <button
                        wire:click="deleteConfirm({{ $property->id }})"
                        type="button"
                        class="btn btn-danger btn-sm">{{ __('Confirm') }}</i>
                    </button>
                @else
                    <button
                        wire:click="delete({{ $property->id }})"
                        type="button"
                        class="btn btn-link btn-sm text-danger"><i class="bi bi-x"></i>
                    </button>
                @endif
            </div>

            @if ($step === 'edit' && $editable_property_id === $property->id)
                <form wire:submit.prevent="submitEdit({{ $property->id }})">
                    <div class="mb-3">
                        <label for="">{{ __('Property title') }}</label>
                        <input wire:model="title" wire:change="generateSlugFromTitle" type="text" class="form-control" placeholder="{{ __('Write property title') }}">
                        @error('title') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">{{ __('Property slug') }}</label>
                        <input wire:model="slug" type="text" class="form-control" placeholder="{{ __('Write property slug') }}">
                        @error('slug') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">{{ __('Property type') }}</label>
                        <select
                            wire:model="type"
                            wire:change="changeType"
                            class="form-control"
                        >
                            <option value="" @selected(!$type)>{{ __('Select one...') }}</option>
                            @foreach (\App\Enums\AdvertCategoryPropertyTypeEnum::cases() as $case)
                                <option value="{{ $case->value }}">{{ $case->value }}</option>
                            @endforeach
                        </select>
                        @error('type') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        @if ($show_type_block !== 'none')
                            @switch($show_type_block)
                                @case('select')
                                    @foreach ($select_options as $key => $option)
                                        <div class="mb-3">
                                            <label for="">{{ __('Option') }} {{ $loop->index + 1 }}</label>
                                            <div class="input-group" style="max-width: 400px;">
                                                <input wire:model="select_options.{{ $key }}.title" class="form-control" type="text" value="{{ $option['title'] }}" />
                                                <input wire:model="select_options.{{ $key }}.value" class="form-control" type="text" value="{{ $option['value'] }}" />
                                                <button
                                                    wire:click="deleteOption({{ $key }})"
                                                    type="button"
                                                    class="btn btn-link btn-sm text-danger"><i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                            @error('select_options.'.$key.'.title') <span class="error">{{ $message }}</span> @enderror
                                            @error('select_options.'.$key.'.value') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    @endforeach

                                    <!-- Add new select value -->
                                    <button
                                        wire:click="addNewSelectOption"
                                        type="button"
                                        class="btn btn-link btn-sm">
                                        {{ __('add option') }}</button>
                                    @break
                            @endswitch
                        @endif
                    </div>


                    <div class="mb-3">
                        <label for="">{{ __('Validation rules') }}</label>
                        <input wire:model="validation_rules" type="text" class="form-control" placeholder="{{ __('Write validation rules') }}">
                        @error('validation_rules') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <button
                        class="btn btn-success btn-sm"><i class="bi bi-save"></i>
                        {{ __('Save property') }}</button>

                    <button
                        wire:click="edit({{ $property->id }})"
                        type="button"
                        class="btn btn-secondary btn-sm">{{ __('Cancel') }}
                    </button>
                </form>
            @endif
        @empty
            {{ __('Category has no properties...') }}
        @endforelse
    </div>

    @if ($step === 'init')
        <div class="mb-3">
            <button
                wire:click="showCreateForm"
                class="btn btn-link btn-sm"><i class="bi bi-plus"></i>
                {{ __('Add new property') }}</button>
        </div>
    @endif

    @if ($step === 'show_create_form')
        <form wire:submit.prevent="submitStore">
            <div class="mb-3">
                <label for="">{{ __('Property title') }}</label>
                <input wire:model="title" wire:change="generateSlugFromTitle" type="text" class="form-control" placeholder="{{ __('Write property title') }}">
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="">{{ __('Property slug') }}</label>
                <input wire:model="slug" type="text" class="form-control" placeholder="{{ __('Write property slug') }}">
                @error('slug') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="">{{ __('Property type') }}</label>
                <select
                    wire:model="type"
                    wire:change="changeType"
                    class="form-control"
                >
                    <option value="" @selected(!$type)>{{ __('Select one...') }}</option>
                    @foreach (\App\Enums\AdvertCategoryPropertyTypeEnum::cases() as $case)
                        <option value="{{ $case->value }}">{{ $case->value }}</option>
                    @endforeach
                </select>
                @error('type') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                @if ($show_type_block !== 'none')
                    @switch($show_type_block)
                        @case('select')
                            @foreach ($select_options as $key => $option)
                                <div class="mb-3">
                                    <label for="">{{ __('Option') }} {{ $loop->index + 1 }}</label>
                                    <div class="input-group" style="max-width: 400px;">
                                        <input wire:model="select_options.{{ $key }}.title" class="form-control" type="text" value="{{ $option['title'] }}" />
                                        <input wire:model="select_options.{{ $key }}.value" class="form-control" type="text" value="{{ $option['value'] }}" />
                                        <button
                                            wire:click="deleteOption({{ $key }})"
                                            type="button"
                                            class="btn btn-link btn-sm text-danger"><i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    @error('select_options.'.$key.'.title') <span class="error">{{ $message }}</span> @enderror
                                    @error('select_options.'.$key.'.value') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            @endforeach

                            <!-- Add new select value -->
                            <button
                                wire:click="addNewSelectOption"
                                type="button"
                                class="btn btn-link btn-sm">
                                {{ __('add option') }}</button>
                            @break
                    @endswitch
                @endif
            </div>


            <div class="mb-3">
                <label for="">{{ __('Validation rules') }}</label>
                <input wire:model="validation_rules" type="text" class="form-control" placeholder="{{ __('Write validation rules') }}">
                @error('validation_rules') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button
                class="btn btn-success btn-sm"><i class="bi bi-save"></i>
                {{ __('Save property') }}</button>

            <button
                wire:click="cancelCreation"
                type="button"
                class="btn btn-secondary btn-sm">{{ __('Cancel') }}</i>
            </button>
        </form>
    @endif

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <span class="text-success"><i class="bi bi-check-circle-fill"></i></span>&nbsp;
                <strong class="me-auto">{{ __('Success') }}</strong>
                <small>{{ __('just now') }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ...
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('propertyEdited', () => {
            const toastDiv = document.getElementById('successToast')
            const toast = new bootstrap.Toast(toastDiv)
            document.querySelector('.toast-body').innerHTML = '{{ __("Property was changed successfuly!") }}';
            toast.show()
        });
    </script>
@endpush
