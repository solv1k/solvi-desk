<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Categories;

use App\Models\AdvertCategory;
use Livewire\Component;

final class AddCategoryBlock extends Component
{
    /** @var string */
    public $step = 'init';

    /** @var string */
    public $title;

    /** @var string */
    public $description;

    /** @var int */
    public $order;

    /** @var int */
    public $parent_category_id;

    /** @var bool */
    public $was_saved = false;

    /** @var string */
    public $saved_title;

    /** @var \Illuminate\Database\Eloquent\Collection<int, static> */
    public $categories;

    protected $rules = [
        'order' => 'nullable|integer|max:250',
        'title' => 'required|min:3|max:100',
        'description' => 'nullable|string|max:1000',
        'parent_category_id' => 'nullable|exists:advertCategories,id',
    ];

    public function render()
    {
        return view('livewire.admin.categories.add-category-block');
    }

    public function clearForm(): void
    {
        $this->title = '';
        $this->description = '';
    }

    public function start(): void
    {
        $this->categories = AdvertCategory::all();
        $this->step = 'creating';
    }

    public function storeInDB(): void
    {
        if (is_null($this->order)) {
            $this->order = 0;
        }

        $validated = $this->validate();

        $category = AdvertCategory::create(
            collect($validated)
                ->except(['parent_category_id'])
                ->toArray()
        );

        $parent = AdvertCategory::findOrFail($validated['parent_category_id']);

        $parent->appendNode($category);
    }

    public function submit(): void
    {
        $this->storeInDB();
        $this->saved_title = $this->title;
        $this->step = 'created';
        $this->clearForm();

        $this->emit('categoryAdded');
    }
}
