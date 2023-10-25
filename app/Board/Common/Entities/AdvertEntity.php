<?php

declare(strict_types=1);

namespace App\Board\Common\Entities;

use App\Board\Common\Base\Data\Entities\BaseEntity;
use App\Board\Common\Enums\Advert\AdvertStatusEnum;
use Carbon\Carbon;

final class AdvertEntity extends BaseEntity
{
    public function __construct(
        public string $id,
        public string $title,
        public ?string $description,
        public ?string $main_image_path,
        public float $price,
        public int|AdvertStatusEnum $status,
        public ?Carbon $deleted_at,
        public Carbon $created_at,
        public Carbon $updated_at,
    ) {
        if (is_int($status)) {
            $this->status = AdvertStatusEnum::from($status);
        }
    }
}
