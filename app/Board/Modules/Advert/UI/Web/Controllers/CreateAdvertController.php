<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\UI\Web\Controllers;

use App\Board\Modules\Advert\Logic\Actions\Write\CreateAdvertAction;
use App\Board\Modules\Advert\UI\Web\Requests\CreateAdvertRequest;
use Illuminate\Contracts\View\View;

final class CreateAdvertController extends AdvertController
{
    public function __invoke(
        CreateAdvertRequest $request,
        CreateAdvertAction $createAdvertAction,
    ): View {
        $requestDto = $request->toDto();

        return view(
            view: $this->facade->view('advert', $requestDto->scope),
            data: ['advert' => $createAdvertAction->run($requestDto)]
        );
    }
}
