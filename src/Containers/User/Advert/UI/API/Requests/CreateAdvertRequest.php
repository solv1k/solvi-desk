<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\UI\API\Requests;

use Illuminate\Validation\Rule;
use Src\Ship\Classes\Base\Requests\BaseApiRequest;

class CreateAdvertRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'advert_category_id' => [Rule::exists('advert_categories', 'id')],
            'title' => ['required', 'min:3', 'max:50'],
            'description' => 'nullable',
            'image' => ['nullable', 'file', 'mimes:png,jpg', 'dimensions:min_width=100,min_height=100', 'max:4096'],
            'price' => ['required', 'min:1', 'max:4294967295']
        ];
    }
}
