<?php

declare(strict_types=1);

namespace App\Actions\User\Phone;

use App\Models\UserPhone;
use App\Services\Verification\Phone\PhoneVerificationService;
use Illuminate\Http\RedirectResponse;
use Livewire\Redirector;

final class VerifyUserPhoneAction
{
    public function __construct(
        protected PhoneVerificationService $phoneVerificationService,
    ) {
    }

    /**
     * Обработчик отправки СМС с кодом верификации телефона.
     */
    public function run(UserPhone $userPhone, string $code): RedirectResponse|Redirector
    {
        // проводим верификацию
        if ($this->phoneVerificationService->verify((string) $userPhone->id, $code) === false) {
            // редиректим назад, если телефон не прошел верификацию
            return back();
        }
        // если коды совпали и все ОК, то делаем телефон верифицированным
        $userPhone->setVerified(true);

        // отправляем пользователя на страницу объявления
        // с сообщением об успешной верификации телефона
        return $this->redirectToLastAdvert()
            ->with('success', __('advert.phone.attached'));
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
}
