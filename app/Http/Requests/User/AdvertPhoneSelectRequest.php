<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AdvertPhoneSelectRequest extends FormRequest
{
    /**
     * Правила авторизации запроса на прикрепление телефона к объявлению.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->advert) 
                && $this->user()->hasPhone($this->user_phone_id);
    }

    /**
     * Правила валидации запроса на прикрепление телефона к объявлению.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_phone_id' => 'required|exists:user_phones,id',
            'contact_name' => 'required|min:3|max:100'
        ];
    }
}