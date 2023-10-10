<?php

declare(strict_types=1);

namespace App\Actions\User\Phone;

use App\Models\UserPhone;
use App\Services\Verification\Phone\PhoneVerificationService;
use Illuminate\Http\RedirectResponse;
use Livewire\Redirector;

class VerifyUserPhoneAction
{
    public function __construct(
        protected PhoneVerificationService $phoneVerificationService,
    ) {}

    /**
     * Обработчик отправки СМС с кодом верификации телефона.
     * 
     * @return RedirectResponse|Redirector
     */
    public function run(UserPhone $userPhone, string $code): RedirectResponse|Redirector
    {
        // проводим верификацию
        if (false === $this->phoneVerificationService->verify((string)$userPhone->id, $code)) {
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
     *
     * @return RedirectResponse|Redirector
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
