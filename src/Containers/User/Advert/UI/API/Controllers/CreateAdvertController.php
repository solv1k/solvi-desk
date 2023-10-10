<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\UI\API\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Containers\User\Advert\Data\DTO\CreateUserAdvertDTO;
use Src\Containers\User\Advert\Data\Repositories\WriteUserAdvertRepository;
use Src\Containers\User\Advert\Data\Repositories\ReadUserAdvertRepository;
use Src\Containers\User\Advert\UI\API\Requests\CreateAdvertRequest;
use Src\Ship\Classes\Base\Controllers\BaseApiController;

class CreateAdvertController extends BaseApiController
{
    /**
     * Create a new advert.
     *
     * @param CreateAdvertRequest $request
     * @param ReadUserAdvertRepository $readRepository
     * @param WriteUserAdvertRepository $writeRepository
     * @return JsonResponse
     */
    public function __invoke(
        CreateAdvertRequest $request,
        ReadUserAdvertRepository $readRepository,
        WriteUserAdvertRepository $writeRepository,
    ): JsonResponse {
        return $this->success([
            'created_advert' => $writeRepository->create(
                dto: CreateUserAdvertDTO::from($request->validatedWithAuthId())
            ),
            'adverts_count' => $readRepository->advertsCount(auth()->id()),
            'liked_adverts_count' => $readRepository->likedAdvertsCount(auth()->id()),
        ]);
    }
}
