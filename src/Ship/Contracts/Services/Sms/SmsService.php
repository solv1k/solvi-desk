<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Services\Sms;

interface SmsService
{
    /**
     * Sending SMS to the specified phone number.
     */
    public function send(string $phoneNumber, string $message): void;
}
