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

    /** @var bool */
    public $show_delete_confirm = false;

    protected $rules = [
        'category.title' => 'required|min:3|max:100',
        'category.description' => 'nullable|string|max:1000'
    ];

    public function mount(AdvertCategory $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.admin.categories.edit-category-block', [
            'category_adverts' => $this->category->adverts()->paginate(5)
        ]);
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

    public function cancelEdit()
    {
        $this->step = 'init';
        $this->show_delete_confirm = false;
    }

    public function showDeleteConfirm()
    {
        $this->show_delete_confirm = true;
    }

    public function hideDeleteConfirm()
    {
        $this->show_delete_confirm = false;
    }

    public function delete()
    {
        $this->category->delete();

        return redirect(route('admin.categories.index'));
    }
}
