<?php

namespace App\Http\Requests\User\Phone;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPhoneRequest extends FormRequest
{
    /**
     * Правила валидации запроса на сохранение нового телефона пользователя.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'number' => 'required|min:11|max:20|starts_with:+7|unique:user_phones,number'
        ];
    }
}
