<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Categories;

use App\Enums\AdvertCategoryPropertyTypeEnum;
use App\Models\AdvertCategory;
use App\Models\AdvertCategoryProperty;
use Ausi\SlugGenerator\SlugGenerator;
use Livewire\Component;

final class EditCategoryPropertiesBlock extends Component
{
    /** @var AdvertCategory */
    public $category;

    /** @var int */
    public $editable_property_id;

    /** @var string */
    public $title;

    /** @var string */
    public $slug;

    /** @var string */
    public $type;

    /** @var string */
    public $step = 'init';

    /** @var string */
    public $validation_rules;

    /** @var string */
    public $show_type_block = 'none';

    /** @var string */
    public $show_delete_button = false;

    /** @var array */
    public $select_options = [];

    /**
     * Правила валидации формы.
     */
    protected $rules = [
        'title' => 'required|min:3|max:100',
        'slug' => 'required|min:3|max:50',
        'type' => 'required|in:string,integer,float,select',
        'validation_rules' => 'nullable|min:2|max:100',
        'select_options' => 'array|nullable',
        'select_options.*.title' => 'required|min:3|max:100',
        'select_options.*.value' => 'required|min:1|max:100',
    ];

    /**
     * Поля для ресета.
     */
    protected $resetable = [
        'title',
        'slug',
        'type',
        'validation_rules',
        'select_options',
        'editable_property_id',
        'show_type_block',
        'show_delete_button',
    ];

    /**
     * Слушатели событий.
     */
    protected $listeners = ['refreshPage' => '$refresh'];

    public function mount(AdvertCategory $category): void
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.admin.categories.edit-category-properties-block');
    }

    public function showCreateForm(): void
    {
        $this->step = 'show_create_form';
    }

    public function changeType(): void
    {
        $this->show_type_block = $this->type;
    }

    public function generateSlugFromTitle(): void
    {
        $this->slug = (new SlugGenerator())->generate($this->title);
    }

    public function addNewSelectOption(): void
    {
        $this->select_options[] = [
            'title' => 'title',
            'value' => 'value',
        ];
    }

    public function cancelCreation(): void
    {
        $this->resetErrorBag();

        $this->reset($this->resetable);

        $this->step = 'init';

        $this->emit('refreshPage');
    }

    public function edit(AdvertCategoryProperty $property): void
    {
        $this->resetErrorBag();

        if ($this->step === 'edit' && $this->editable_property_id === $property->id) {
            $this->reset($this->resetable);
            $this->step = 'init';

            return;
        }

        foreach ($property->toArray() as $key => $attribute) {
            if (property_exists($this, $key)) {
                $this->{$key} = $attribute;
            }
        }

        $this->reset('select_options');

        if ($property->additional_data && $property->type == AdvertCategoryPropertyTypeEnum::SELECT->value) {
            $this->select_options = json_decode($property->additional_data, true);
        }

        $this->show_type_block = $this->type;

        $this->editable_property_id = $property->id;

        $this->step = 'edit';
    }

    public function deleteOption(int $index): void
    {
        unset($this->select_options[$index]);
    }

    public function delete(AdvertCategoryProperty $property): void
    {
        if ($this->show_delete_button && $this->editable_property_id === $property->id) {
            $this->show_delete_button = false;
            $this->editable_property_id = 0;

            return;
        }

        $this->editable_property_id = $property->id;
        $this->show_delete_button = true;
    }

    public function deleteConfirm(AdvertCategoryProperty $property): void
    {
        $property->delete();

        $this->emit('refreshPage');
    }

    public function submitEdit(AdvertCategoryProperty $property): void
    {
        $validated = $this->validate();

        $property->update(collect($validated)->except(['select_options'])->toArray());

        if (! empty($this->select_options)) {
            $property->additional_data = json_encode($this->select_options);
            $property->save();
        }

        $this->reset($this->resetable);

        $this->step = 'init';

        $this->emit('refreshPage');
    }

    public function submitStore(): void
    {
        $validated = $this->validate();

        $property = $this->category->properties()->create(collect($validated)->except(['select_options'])->toArray());

        if (! empty($this->select_options)) {
            $property->additional_data = json_encode($this->select_options);
            $property->save();
        }

        $this->category->fresh();

        $this->reset($this->resetable);

        $this->step = 'init';

        $this->emit('refreshPage');
    }
}
