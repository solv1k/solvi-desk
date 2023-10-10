<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\Data\Repositories;

use App\Models\Advert;
use App\Models\AdvertUserLike;
use Src\Ship\Classes\Base\Data\BaseEloquentRepository;

class EloquentReadUserAdvertRepository extends BaseEloquentRepository implements ReadUserAdvertRepository
{
    /**
     * Adding a query to search for user ads by ID.
     *
     * @param integer $userId
     * @param integer $advertId
     * @return static
     */
    public function findById(int $userId, int $advertId): static
    {
        $this->builder = Advert::query()
            ->where('user_id', $userId)
            ->where('id', $advertId)
            ->limit(1);
        return $this;
    }

    /**
     * Adding a query to search for all of a users ads.
     *
     * @param integer $userId
     * @return static
     */
    public function all(int $userId): static
    {
        $this->builder = Advert::query()->where('user_id', $userId);
        return $this;
    }

    /**
     * Total count of user ads.
     *
     * @param integer $userId
     * @return integer
     */
    public function advertsCount(int $userId): int
    {
        return Advert::query()->where('user_id', $userId)->count();
    }

    /**
     * Total ads count liked by user.
     *
     * @param integer $userId
     * @return integer
     */
    public function likedAdvertsCount(int $userId): int
    {
        return AdvertUserLike::query()->where('user_id', $userId)->count();
    }
}
