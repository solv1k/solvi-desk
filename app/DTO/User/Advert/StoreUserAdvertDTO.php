<?php

declare(strict_types=1);

namespace App\DTO\User\Advert;

use App\Global\Base\DTO\BaseDTO;

class StoreUserAdvertDTO extends BaseDTO
{
    public function __construct(

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
