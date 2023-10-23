<?php

declare(strict_types=1);

namespace App\Services\Verification\Phone;

final class SessionPhoneVerificationService implements PhoneVerificationService
{
    public const KEY_PREFIX = 'phone_verification_';

    /**
     * Сохраняет код верификации телефона с указанным ключом.
     */
    public function put(string $key, string $code): void
    {
        session([self::KEY_PREFIX . $key => $code]);
    }

    /**
     * Проводит верификацию телефона по коду и ключу.
     */
    public function verify(string $key, string $code): bool
    {
        // получаем из сессии код верификации
        $sessionCode = session(self::KEY_PREFIX . $key);
        // если в сессии нет кода, то возвращаем пользователя назад
        if (! $sessionCode) {
            session(['error' => __('Session expired.')]);

            return false;
        }
        // если коды не совпадают, то возвращаем пользователя назад
        if ((int) $sessionCode !== (int) $code) {
            session(['error' => __('Wrong code.')]);

            return false;
        }

        return true;
    }
}
