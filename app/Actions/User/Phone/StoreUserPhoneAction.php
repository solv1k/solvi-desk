<?php

declare(strict_types=1);

namespace App\Actions\User\Phone;

use App\DTO\User\Phone\StoreUserPhoneDTO;
use App\Models\User;
use App\Models\UserPhone;

class StoreUserPhoneAction
{
    /**
     * Сохраняет новый номер телефона пользователя и возвращает его.
     * 
     * @return 
     */
    public function run(User $user, StoreUserPhoneDTO $dto): UserPhone
    {
        return $user
            ->phones()
            ->where('number', $dto->number)
            ->firstOrCreate($dto->toArray());
    }
}
