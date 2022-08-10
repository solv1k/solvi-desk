<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdvertPhoneRequest;
use App\Http\Requests\User\AdvertPhoneSelectRequest;
use App\Models\Advert;
use Illuminate\Http\Request;

class AdvertPhoneController extends Controller
{
    /**
     * Страница выбора телефона объявления.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(AdvertPhoneRequest $request, Advert $advert)
    {
        // сохраняем ID объявления в сессию, это может понадобится для верификации телефона
        session(['last_advert_id' => $advert->id]);
        
        return view('user.adverts.phones.select', compact('advert'));
    }

    /**
     * Обработчик события прикрепления телефона к объявлению.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attach(AdvertPhoneSelectRequest $request, Advert $advert)
    {
        $advert->setSelectedUserPhone($request->validated('user_phone_id'), $request->contact_name);

        return redirect(route('user.adverts.list'));
    }
}
