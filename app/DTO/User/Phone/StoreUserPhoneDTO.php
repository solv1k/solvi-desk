<?php

declare(strict_types=1);

namespace App\DTO\User\Phone;

use App\Global\Base\DTO\BaseDTO;

class StoreUserPhoneDTO extends BaseDTO
{
    public function __construct(

        public string $number,
        
    ) {

    }
}
