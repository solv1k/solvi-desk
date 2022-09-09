<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvertCategory;

class CategoriesController extends Controller
{
    /**
     * Страница управления категориями.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Страница просмотра конкретной категории.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function view(AdvertCategory $category)
    {
        $category_adverts = $category->adverts()->paginate(5);

        return view('admin.categories.single', compact(
            'category',
            'category_adverts'
        ));
    }
}
