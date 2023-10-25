<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Data\DTO;

use App\Board\Common\Base\Data\DTO\BaseDTO;

final class CreateAdvertDTO extends BaseDTO
{
    public function __construct(
        public int $user_id,
        public int $advert_category_id,
        public string $title,
        public string $description,
        public float $price,
    ) {
    }
}
