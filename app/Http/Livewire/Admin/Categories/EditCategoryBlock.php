<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\AdvertCategory;
use Livewire\Component;

class EditCategoryBlock extends Component
{
    /** @var AdvertCategory */
    public $category;

    /** @var string */
    public $step = 'init';

    protected $rules = [
        'category.title' => 'required|min:6|max:100',
        'category.description' => 'nullable|string|max:1000'
    ];

    public function mount(AdvertCategory $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.admin.categories.edit-category-block');
    }

    public function edit()
    {
        $this->step = 'edit';
    }

    public function submit()
    {
        $this->validate();

        $this->category->save();

        $this->step = 'init';
    }
}
