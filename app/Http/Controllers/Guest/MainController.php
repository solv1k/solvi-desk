<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Главная страница сайта.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function home()
    {
        $adverts = Advert::active()->paginate();

        return view('guest.home', compact('adverts'));
    }
}
