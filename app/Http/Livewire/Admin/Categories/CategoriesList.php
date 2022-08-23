<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Advert;
use App\Models\AdvertCategory;
use Livewire\Component;

class CategoriesList extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection<int, static> */
    public $categories;

    protected $listeners = ['categoryAdded' => 'loadCategories'];

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = AdvertCategory::whereIsRoot()->get();
    }

    public function render()
    {
        return view('livewire.admin.categories.categories-list');
    }
}
