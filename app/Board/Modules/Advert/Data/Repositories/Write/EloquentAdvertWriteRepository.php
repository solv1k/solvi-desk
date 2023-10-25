<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Data\Repositories\Write;

use App\Board\Common\Entities\AdvertEntity;
use App\Board\Modules\Advert\Data\DTO\CreateAdvertDTO;
use App\Models\Advert;

final class EloquentAdvertWriteRepository implements AdvertWriteRepository
{
    public function create(CreateAdvertDTO $dto): AdvertEntity
    {
        return AdvertEntity::from(
            Advert::query()->create([
                'user_id' => $dto->user_id,
                'advert_category_id' => $dto->advert_category_id,
                'title' => $dto->title,
                'description' => $dto->description,
                'price' => $dto->price,
            ])
        );
    }
}
