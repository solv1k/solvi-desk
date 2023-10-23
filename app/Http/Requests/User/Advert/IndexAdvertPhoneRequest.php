<?php

declare(strict_types=1);

namespace App\Http\Requests\User\Advert;

use Illuminate\Foundation\Http\FormRequest;

final class IndexAdvertPhoneRequest extends FormRequest
{
    /**
     * Правила авторизации запроса на выбор телефона для прикрепления к объявлению.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->advert);
    }

    /**
     * Правила валидации запроса на выбор телефона для прикрепления к объявлению.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
