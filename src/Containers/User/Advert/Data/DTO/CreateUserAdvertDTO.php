<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\Data\DTO;

use Src\Ship\Classes\Base\Data\BaseDTO;

class CreateUserAdvertDTO extends BaseDTO
{
    public function __construct(

        public int $user_id,

        public int $advert_category_id,

        public string $title,

        public ?string $description,

        public float $price,
        
    ) {
        $this->description = $this->description 
            ? raw_string_to_html($this->description)
            : null;
    }
}
