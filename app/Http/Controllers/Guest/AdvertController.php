<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    /**
     * Страница конкретного объявления.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function view(Advert $advert)
    {
        return view('guest.adverts.single', compact('advert'));
    }
}
