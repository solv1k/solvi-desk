<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPhoneStoreRequest;
use Illuminate\Http\Request;

class UserPhoneController extends Controller
{
    /**
     * Список всех телефонов пользователя.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('user.phones.list');
    }

    /**
     * Страница добавления нового телефона.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function attach()
    {
        return view('user.phones.forms.attach');
    }

    /**
     * Обработчик сохранения нового телефона.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserPhoneStoreRequest $request)
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        $user->phones()->create($request->validated());

        return back()->with('success', __('advert.phone.attached'));
    }
}
