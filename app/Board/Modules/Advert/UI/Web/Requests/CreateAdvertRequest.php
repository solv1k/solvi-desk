<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\UI\Web\Requests;

use App\Board\Common\Base\UI\Web\Requests\AuthorizedWebRequest;
use Illuminate\Validation\Rule;

final class CreateAdvertRequest extends AuthorizedWebRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function validationRules(): array
    {
        return [
            'data.advert_category_id' => ['required', Rule::exists('advert_categories', 'id')],
            'data.title' => ['required', 'string', 'max:255'],
            'data.description' => ['required', 'string', 'max:2000'],
            'data.price' => ['required', 'decimal:2'],
        ];
    }
}
