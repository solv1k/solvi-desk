<?php

declare(strict_types=1);

namespace App\Actions\User\Phone;

use App\Models\UserPhone;
use App\Services\Sms\SmsService;
use App\Services\Verification\Phone\PhoneVerificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Redirector;

final class SendVerificationUserPhoneAction
{
    public function __construct(
        protected PhoneVerificationService $phoneVerificationService,
        protected SmsService $smsService
    ) {

    }

    /**
     * Обработчик отправки СМС с кодом верификации телефона.
     */
    public function run(UserPhone $userPhone): RedirectResponse|Redirector|null
    {
        if ($userPhone->verified) {
            return $this->redirectToLastAdvert();
        }

        $this->sendSmsWithCode($userPhone);

        return null;
    }

    /**
     * Редирект к последнему объявлению.
     */
    protected function redirectToLastAdvert(): RedirectResponse|Redirector
    {
        // получаем ID последнего объявления из сессии
        $advert_id = session('last_advert_id');

        // и возвращаем редик на страницу с выбором телефона
        return $advert_id
                ? redirect(route('user.adverts.phones.list', $advert_id))
                : redirect(route('user.adverts.list'));
    }

    /**
     * Отправка СМС с кодом верификации телефона.
     */
    protected function sendSmsWithCode(UserPhone $userPhone): void
    {
        // ограничиваем отправку СМС (1 раз в 30 секунд)
        RateLimiter::attempt(
            key: 'sms-send:' . auth()->id(),
            maxAttempts: 1,
            decaySeconds: 30,
            callback: function () use ($userPhone): void {
                // генерируем 6-значный код
                $code = fake()->numerify('######');
                // отправляем СМС с кодом
                $this->smsService->send(
                    phoneNumber: $userPhone->number,
                    message: __('Verification code') . ': ' . $code
                );
                // сохраняем код в сервисе верификации
                $this->phoneVerificationService
                    ->put((string) $userPhone->id, $code);
            }
        );
    }
}
