<?php

namespace App\Http\Requests\User;

use App\Models\Advert;
use Illuminate\Foundation\Http\FormRequest;

class AdvertStoreRequest extends FormRequest
{
    /**
     * Правила авторизации запроса для создания нового объявления.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Advert::class);
    }

    /**
     * Правила валидации запроса для создания нового объявления.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'advert_category_id' => 'required|exists:advert_categories,id',
            'title' => 'required|min:3|max:50',
            'description' => 'nullable',
            'image' => 'nullable|file|mimes:png,jpg|dimensions:min_width=100,min_height=100|max:4096',
            'price' => 'required|min:1|max:4294967295'
        ];
    }
}
