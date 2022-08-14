<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserPhoneStoreRequest;
use App\Http\Requests\User\UserPhoneVerificationRequest;
use App\Models\UserPhone;
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

        $phone = $user->phones()->create($request->validated());

        return redirect(route('user.phones.verify.page', $phone->id));
    }

    /**
     * Страница верификации номера телефона.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function verifyPage(Request $request, UserPhone $user_phone)
    {
        if (! $request->user()->can('update', $user_phone)) {
            abort(403);
        }
        // генерируем 6-значный код
        $code = random_int(111111,999999);
        // сохраняем код в сессии
        session(['phone_verification_code_' . $user_phone->id => $code]);
        // отправляем пользователя на страницу верификации телефона
        return view('user.phones.verify-page', compact('user_phone'));
    }

    /**
     * Обработчик верификации номера телефона.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyHandler(UserPhoneVerificationRequest $request, UserPhone $user_phone)
    {
        // получаем из сессии 6-значный код верификации
        $code = session('phone_verification_code_' . $user_phone->id);
        // если в сессии нет кода, то возвращаем пользователя назад
        if (! $code) {
            return back()->with('error', __('Session expired.'));
        }
        // если коды не совпадают, то возвращаем пользователя назад
        if ((int)$code !== (int)$request->code) {
            return back()->with('error', __('Wrong code.'));
        }
        // если коды совпали и все ОК, то делаем телефон верифицированным
        $user_phone->setVerified(true);
        // получаем страницу последнего объявления из сессии
        $advert_id = session('last_advert_id');
        // формируем редирект
        $redirect = $advert_id
                    ? redirect(route('user.adverts.phones.list', $advert_id)) 
                    : redirect(route('user.adverts.list'));
        // отправляем пользователя с успехом
        return $redirect->with('success', __('advert.phone.attached'));
    }
}
