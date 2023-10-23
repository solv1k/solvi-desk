<?php

declare(strict_types=1);

namespace App\Services\Verification\Phone;

interface PhoneVerificationService
{
    /**
     * Сохраняет код верификации телефона с указанным ключом.
     */
    public function put(string $key, string $code): void;

    /**
     * Проводит верификацию телефона по коду и ключу.
     */
    public function verify(string $key, string $code): bool;
}
