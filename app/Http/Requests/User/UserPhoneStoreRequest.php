<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserPhoneStoreRequest extends FormRequest
{
    /**
     * Правила валидации запроса на сохранение нового телефона пользователя.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'number' => 'required|min:7|max:20|starts_with:+7|unique:user_phones,number'
        ];
    }
}
