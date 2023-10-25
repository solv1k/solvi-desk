<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Data\Repositories\Read;

use App\Board\Common\Base\Data\DataPaginator;
use App\Board\Common\Entities\AdvertEntity;
use App\Models\Advert;

final class EloquentAdvertReadRepository implements AdvertReadRepository
{
    public function paginate(): DataPaginator
    {
        return AdvertEntity::paginate(Advert::query()->paginate());
    }
}
