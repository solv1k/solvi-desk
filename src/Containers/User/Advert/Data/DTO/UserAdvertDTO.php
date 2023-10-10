<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\Data\DTO;

use Src\Ship\Classes\Base\Data\BaseDTO;

class UserAdvertDTO extends BaseDTO
{
    public function __construct(

        public int $id,

        public int $user_id,

        public int $advert_category_id,

        public string $title,

        public ?string $description,

        public float $price,
        
    ) {}
}
