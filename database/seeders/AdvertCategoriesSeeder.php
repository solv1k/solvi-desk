<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AdvertCategory;
use Illuminate\Database\Seeder;

final class AdvertCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // создаем основные категории объявлений
        AdvertCategory::create([
            'title' => 'Разное',
            'description' => 'В этой категории находятся объявления, которые не были размещены в какую-либо категорию.',
        ]);
        AdvertCategory::create([
            'title' => 'Личные вещи',
        ]);
        AdvertCategory::create([
            'title' => 'Транспорт',
        ]);
        AdvertCategory::create([
            'title' => 'Недвижимость',
        ]);
    }
}
