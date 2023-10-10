<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Services\Verification;

interface PhoneVerificationService
{
    /**
     * Saves the phone verification code with the specified key.
     */
    public function put(string $key, string $code): void;

    /**
     * Verifies the phone by code and key.
     */
    public function verify(string $key, string $code): bool;
}
