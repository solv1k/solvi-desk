<?php

declare(strict_types=1);

namespace App\Services\Sms;

class FakeSmsService implements SmsService
{
    /**
     * Отправка SMS-сообщения на указанный номер телефона.
     *
     * @param string $phoneNumber
     * @param string $message
     * @return void
     */
    public function send(string $phoneNumber, string $message): void
    {
        // выводим сообщение в дебаггер для тестов
        debugbar()->info("[SMS] $phoneNumber: $message");
    }
}
