<?php

declare(strict_types=1);

namespace App\Board\Common\Base\UI\Web\Requests;

use App\Board\Common\Contracts\Requests\FormRequest as FormRequestContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class BaseWebRequest extends FormRequest implements FormRequestContract
{
    public function baseRules(): array
    {
        return [
            'scope' => ['required', Rule::in(['guest', 'admin', 'user'])],
        ];
    }

    public function rules(): array
    {
        return array_merge(
            $this->baseRules(),
            $this->validationRules()
        );
    }
}
