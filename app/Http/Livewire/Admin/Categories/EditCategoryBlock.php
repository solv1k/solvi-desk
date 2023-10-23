<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Categories;

use App\Models\AdvertCategory;
use Livewire\Component;

final class EditCategoryBlock extends Component
{
    /** @var AdvertCategory */
    public $category;

    /** @var string */
    public $step = 'init';

    /** @var bool */
    public $show_delete_confirm = false;

    /**
     * Правила валидации формы.
     */
    protected $rules = [
        'category.title' => 'required|min:3|max:100',
        'category.description' => 'nullable|string|max:1000',
    ];

    public function mount(AdvertCategory $category): void
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.admin.categories.edit-category-block');
    }

    public function edit(): void
    {
        $this->step = 'edit';
    }

    public function submit(): void
    {
        $this->validate();

        $this->category->save();

        $this->step = 'init';
    }

    public function cancelEdit(): void
    {
        $this->step = 'init';
        $this->show_delete_confirm = false;
    }

    public function showDeleteConfirm(): void
    {
        $this->show_delete_confirm = true;
    }

    public function hideDeleteConfirm(): void
    {
        $this->show_delete_confirm = false;
    }

    public function delete()
    {
        $this->category->delete();

        return redirect(route('admin.categories.index'));
    }
}
