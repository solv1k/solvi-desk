<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\UI\Web\Requests;

use App\Board\Common\Base\UI\Web\Requests\AuthorizedWebRequest;

final class ListAdvertRequest extends AuthorizedWebRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function validationRules(): array
    {
        return [];
    }
}
