<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Advert\AttachAdvertPhoneRequest;
use App\Http\Requests\User\Advert\IndexAdvertPhoneRequest;
use App\Models\Advert;

final class AdvertPhoneController extends Controller
{
    /**
     * Страница выбора телефона объявления.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(IndexAdvertPhoneRequest $request, Advert $advert)
    {
        // сохраняем ID объявления в сессии, оно потребуется для верификации телефона
        session(['last_advert_id' => $advert->id]);

        return view('user.adverts.phones.select', compact('advert'));
    }

    /**
     * Обработчик события прикрепления телефона к объявлению.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attach(AttachAdvertPhoneRequest $request, Advert $advert)
    {
        $advert->setSelectedUserPhone(
            $request->validated('user_phone_id'),
            $request->contact_name
        );

        return redirect(route('user.adverts.list'))
            ->with('success', __('Phone linked successfuly!'));
    }
}
