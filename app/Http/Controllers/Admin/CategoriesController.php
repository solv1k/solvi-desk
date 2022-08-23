<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvertCategory;
use Illuminate\Http\Request;

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

    public function view(AdvertCategory $category)
    {
        return $category;
    }
}
