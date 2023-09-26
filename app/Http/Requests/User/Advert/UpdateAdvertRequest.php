<?php

namespace App\Http\Requests\User\Advert;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->advert);
    }

    /**
     * Get the validation rules that apply to the request.
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
