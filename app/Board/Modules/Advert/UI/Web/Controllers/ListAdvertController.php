<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\UI\Web\Controllers;

use App\Board\Modules\Advert\Logic\Actions\Read\ListAdvertAction;
use App\Board\Modules\Advert\UI\Web\Requests\ListAdvertRequest;
use Illuminate\Contracts\View\View;

final class ListAdvertController extends AdvertController
{
    public function __invoke(
        ListAdvertRequest $request,
        ListAdvertAction $listAdvertAction,
    ): View {
        return view(
            view: $this->facade->view('advert-list', $request->toDto()->scope),
            data: ['adverts' => $listAdvertAction->run()]
        );
    }
}
