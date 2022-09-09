<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use App\Models\AdvertCategory;

class DashboardController extends Controller
{
    /**
     * Главная страница панели администратора.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $adverts_count = Advert::count();
        $new_adverts_count = Advert::waitModeration()->count();
        $categories_count = AdvertCategory::count();

        return view('admin.dashboard.index', compact(
            'adverts_count',
            'new_adverts_count',
            'categories_count'
        ));
    }
}
