<?php

declare(strict_types=1);

namespace App\Actions\User\Phone;

use App\Models\UserPhone;
use App\Services\Sms\SmsService;
use Illuminate\Http\RedirectResponse;

class SendVerificationUserPhoneAction
{
    public function __construct(
        protected SmsService $smsService
    ) {
        
    }

    /**
     * Обработчик отправки СМС с кодом верификации телефона.
     * 
     * @return RedirectResponse|null
     */
    public function run(UserPhone $userPhone): ?RedirectResponse
    {
        if ($userPhone->verified) {
            return $this->redirectToAdvert();
        }

        return $this->sendSmsWithCode($userPhone);
    }

    /**
     * Редирект к последнему объявлению.
     *
     * @return RedirectResponse
     */
    protected function redirectToAdvert(): RedirectResponse
    {
        // получаем ID объявления из сессии
        $advert_id = session('last_advert_id');
        // и возвращаем редик на страницу с выбором телефона
        return $advert_id
                ? redirect(route('user.adverts.phones.list', $advert_id))
                : redirect(route('user.adverts.list'));
    }

    /**
     * Отправка СМС с кодом верификации телефона.
     *
     * @param UserPhone $userPhone
     * @return void
     */
    protected function sendSmsWithCode(UserPhone $userPhone): void
    {
        // генерируем 6-значный код
        $code = random_int(111111, 999999);
        // отправляем СМС с кодом
        $this->smsService->send(
            phoneNumber: $userPhone->number,
            message: __('Verification code') . ': ' . $code
        );
        // сохраняем код в сессии
        session(['phone_verification_code_' . $userPhone->id => $code]);
    }
}
