<div>
    <label for="advert_category_id">{{ __('Select advert category') }}:</label>

    <input wire:model="advert_category_id" type="hidden" name="advert_category_id" id="advert_category_id">

    @foreach ($selects as $key => $select)
        <select wire:change="updateSelects({{ $key }})" wire:model="selects.{{ $loop->index }}.selected" class="form-control">
            <option value="0">{{ __('Select one...') }}</option>
            @foreach ($select['options'] as $option)
                <option value="{{ $option['value'] }}" @selected($option['value'] === $select['selected'])>{{ $option['title'] }}</option>
            @endforeach
        </select>
    @endforeach
</div>
