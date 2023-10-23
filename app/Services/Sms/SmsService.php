<?php

declare(strict_types=1);

namespace App\Services\Sms;

interface SmsService
{
    /**
     * Отправка SMS-сообщения на указанный номер телефона.
     */
    public function send(string $phoneNumber, string $message): void;
}
