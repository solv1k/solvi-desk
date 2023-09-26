<?php

declare(strict_types=1);

namespace App\Services\Sms;

interface SmsService
{
    /**
     * Отправка SMS-сообщения на указанный номер телефона.
     *
     * @param string $phoneNumber
     * @param string $message
     * @return void
     */
    public function send(string $phoneNumber, string $message): void;
}
