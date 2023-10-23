<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Categories;

use App\Models\AdvertCategory;
use Livewire\Component;

final class CategoriesList extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection */
    public $categories;

    protected $listeners = ['categoryAdded' => 'loadCategories'];

    public function mount(): void
    {
        $this->loadCategories();
    }

    public function loadCategories(): void
    {
        $this->categories = AdvertCategory::whereIsRoot()->get();
    }

    public function render()
    {
        return view('livewire.admin.categories.categories-list');
    }
}
