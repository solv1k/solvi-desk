<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use Illuminate\Http\Request;

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
        $active_adverts_count = Advert::active()->count();
        $new_adverts_count = Advert::waitModeration()->count();

        return view('admin.dashboard.index', compact(
            'adverts_count', 
            'active_adverts_count', 
            'new_adverts_count'
        ));
    }
}
