<?php

declare(strict_types=1);

namespace App\Actions\User\Phone;

use App\Models\UserPhone;
use Illuminate\Http\RedirectResponse;

class VerifyUserPhoneAction
{
    /**
     * Обработчик отправки СМС с кодом верификации телефона.
     * 
     * @return RedirectResponse
     */
    public function run(UserPhone $userPhone, string $code): RedirectResponse
    {
        // получаем из сессии 6-значный код верификации
        $sessionCode = session('phone_verification_code_' . $userPhone->id);
        // если в сессии нет кода, то возвращаем пользователя назад
        if (! $sessionCode) {
            return back()->with('error', __('Session expired.'));
        }
        // если коды не совпадают, то возвращаем пользователя назад
        if ((int)$sessionCode !== (int)$code) {
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

        // отправляем пользователя с успешной привязкой телефона
        return $redirect->with('success', __('advert.phone.attached'));
    }
}
