<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\Data\Repositories;

use App\Enums\AdvertStatusEnum;
use App\Models\Advert;
use Src\Containers\User\Advert\Data\DTO\CreateUserAdvertDTO;
use Src\Containers\User\Advert\Data\DTO\UpdateUserAdvertDTO;
use Src\Containers\User\Advert\Data\DTO\UserAdvertDTO;
use Src\Ship\Classes\Base\Data\BaseEloquentRepository;

class EloquentWriteUserAdvertRepository extends BaseEloquentRepository implements WriteUserAdvertRepository
{
    /**
     * Create new advert for user.
     *
     * @param CreateUserAdvertDTO $dto
     * @return UserAdvertDTO
     */
    public function create(CreateUserAdvertDTO $dto): UserAdvertDTO
    {
        return UserAdvertDTO::from(Advert::query()->create($dto->toArray()));
    }

    /**
     * Updating user advert.
     *
     * @param UpdateUserAdvertDTO $dto
     * @return integer
     */
    public function update(UpdateUserAdvertDTO $dto): int
    {
        return Advert::query()
            ->where('user_id', $dto->user_id)
            ->where('id', $dto->id)
            ->update($dto->exclude('user_id', 'id')->toArray());   
    }

    /**
     * Set main image for advert.
     *
     * @param integer $advertId
     * @param string $imagePath
     * @return void
     */
    public function setMainImage(int $advertId, string $imagePath): void
    {
        Advert::query()
            ->where('id', $advertId)
            ->update(['main_image_path' => $imagePath]);
    }

    /**
     * Set the "WAIT PHONE" status for advert.
     *
     * @param integer $advertId
     * @return void
     */
    public function setWaitPhoneStatus(int $advertId): void
    {
        Advert::query()
            ->where('id', $advertId)
            ->update(['status' => AdvertStatusEnum::WAIT_PHONE]);
    }
}
