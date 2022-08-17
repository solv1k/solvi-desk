<?php

namespace Database\Factories;

use App\Models\AdvertCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advert>
 */
class AdvertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'advert_category_id' => AdvertCategory::factory(),
            'title' => 'Test advert #1',
            'price' => 123000
        ];
    }
}
