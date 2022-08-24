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
     * Обработчик проверки телефона перед сохранением.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeChecker(Request $request)
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        $phone = $request->has('number') 
                ? $user->phones()->where('number', $request->number)->first() 
                : null;

        if ($phone) {
            // если телефон уже подтвержден
            if ($phone->verified) {
                // получаем страницу последнего объявления из сессии
                $advert_id = session('last_advert_id');
                // формируем редирект
                return $advert_id
                        ? redirect(route('user.adverts.phones.list', $advert_id))
                        : redirect(route('user.adverts.list'));
            }
            // если телефон принадлежит пользователю, то редиректим на верификацию телефона
            return redirect(route('user.phones.verify.page', $phone->id));
        } else {
            // иначе пробуем добавить новый телефон
            return $this->store(UserPhoneStoreRequest::createFrom($request));
        }
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

        $phone = $user->phones()->create($request->validate($request->rules()));

        return redirect(route('user.phones.verify.page', $phone->id));
    }

    /**
     * Страница верификации номера телефона.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function verifyPage(Request $request, UserPhone $userPhone)
    {
        if (!$request->user()->can('update', $userPhone)) {
            abort(403);
        }
        // генерируем 6-значный код
        $code = random_int(111111, 999999);
        // выводим код в дебаггер для тестов
        debugbar()->info($code);
        // сохраняем код в сессии
        session(['phone_verification_code_' . $userPhone->id => $code]);
        // отправляем пользователя на страницу верификации телефона
        return view('user.phones.forms.verify-page', compact('userPhone'));
    }

    /**
     * Обработчик верификации номера телефона.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyHandler(UserPhoneVerificationRequest $request, UserPhone $userPhone)
    {
        // получаем из сессии 6-значный код верификации
        $code = session('phone_verification_code_' . $userPhone->id);
        // если в сессии нет кода, то возвращаем пользователя назад
        if (!$code) {
            return back()->with('error', __('Session expired.'));
        }
        // если коды не совпадают, то возвращаем пользователя назад
        if ((int)$code !== (int)$request->code) {
            return back()->with('error', __('Wrong code.'));
        }
        // если коды совпали и все ОК, то делаем телефон верифицированным
        $userPhone->setVerified(true);
        // получаем страницу последнего объявления из сессии
        $advert_id = session('last_advert_id');
        // формируем редирект
        $redirect = $advert_id
            ? redirect(route('user.adverts.phones.list', $advert_id))
            : redirect(route('user.adverts.list'));
        // отправляем пользователя с успехом
        return $redirect->with('success', __('advert.phone.attached'));
    }

    /**
     * Отмена верификации номера телефона.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyCancel(Request $request, UserPhone $userPhone)
    {
        if (!$request->user()->can('delete', $userPhone)) {
            abort(403);
        }

        $userPhone->delete();

        return back();
    }
}
