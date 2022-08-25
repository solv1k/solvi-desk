<?php

namespace App\Http\Livewire\User\Adverts;

use App\Models\Advert;
use App\Models\AdvertCategory;
use Livewire\Component;

class CategorySelectorBlock extends Component
{
    /** @var ?Advert */
    public $advert;

    /** @var string */
    public $mode;

    /** @var int */
    public $advert_category_id;

    /** @var array */
    public $selects = [];

    public function mount(?Advert $advert, string $mode = 'create')
    {
        $this->advert = $advert;
        $this->mode = $mode;
        $this->advert_category_id = $advert->advert_category_id;
        $this->mountSelects();
    }

    public function mountSelects()
    {
        if ($this->mode === 'create') {
            $this->selects[] = [
                'selected' => $this->advert_category_id,
                '_selected' => $this->advert_category_id,
                'options' => $this->getRootOptions()
            ];
            return;
        }

        foreach ($this->advert->category->ancestors as $ancested_category) {
            $this->selects[] = [
                'selected' => $ancested_category->id,
                '_selected' => $ancested_category->id,
                'options' => $this->getSiblingsAndSelfOptions($ancested_category)
            ];
        }

        $this->selects[] = [
            'selected' => $this->advert_category_id,
            '_selected' => $this->advert_category_id,
            'options' => $this->getSiblingsAndSelfOptions($this->advert->category)
        ];
    }

    public function updateSelects(int $select_index)
    {
        if ($this->selects[$select_index]['selected'] !== $this->selects[$select_index]['_selected']) {
            array_splice($this->selects, $select_index + 1);

            $this->loadNextSelect($this->selects[$select_index]['selected']);
        }
    }

    public function loadNextSelect(int $parent_category_id)
    {
        $childs = AdvertCategory::findOrFail($parent_category_id)->children;

        if ($childs->count() > 0) {
            $this->advert_category_id = 0;
            $this->selects[] = [
                'selected' => 0,
                '_selected' => 0,
                'options' => $childs->map(function($category) {
                    return [
                        'value' => $category->id,
                        'title' => $category->title
                    ];
                })
            ];
        } else {
            $this->advert_category_id = $parent_category_id;
        }
    }

    public function getSiblingsAndSelfOptions(AdvertCategory $category)
    {
        $options[] = [
            'value' => $category->id,
            'title' => $category->title
        ];

        $options = array_merge($options, $category->siblings()->get()->map(function($category_sibling) {
            return [
                'value' => $category_sibling->id,
                'title' => $category_sibling->title
            ];
        })->toArray());

        return $options;
    }

    public function getRootOptions()
    {
        $root_advert_categories = AdvertCategory::whereIsRoot()->get();

        return $root_advert_categories->map(function($item) {
            return [
                'value' => $item->id,
                'title' => $item->title
            ];
        });
    }

    public function render()
    {
        return view('livewire.user.adverts.category-selector-block');
    }
}
