<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AdvertCategory;
use App\Models\BannerPosition;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // создаём основные настройки
        GeneralSetting::create([
            'key' => 'currency',
            'value' => 'Рубли РФ'
        ]);
        GeneralSetting::create([
            'key' => 'currency_symbol',
            'value' => 'RUB'
        ]);

        // создаём админа
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com'
        ])->giveAdminPermissions();

        // создаем основные категории объявлений
        AdvertCategory::create([
            'title' => 'Разное',
            'description' => 'В этой категории находятся объявления, которые не были размещены в какую-либо категорию.'
        ]);
        AdvertCategory::create([
            'title' => 'Личные вещи'
        ]);
        AdvertCategory::create([
            'title' => 'Транспорт'
        ]);
        AdvertCategory::create([
            'title' => 'Недвижимость'
        ]);

        // создаем позиции для баннерной рекламы
        BannerPosition::create([
            'title' => 'Центральный баннер',
            'description' => 'Находится в верхней части сайта, занимает всю ширину активного экрана.',
            'width' => 1280,
            'height' => 80,
            'daily_price' => 3500
        ]);
        BannerPosition::create([
            'title' => 'Боковой баннер',
            'description' => 'Находится в правой части сайта, рядом со списком объявлений, это самое популярное место для рекламы.',
            'width' => 300,
            'height' => 600,
            'daily_price' => 2800
        ]);
    }
}
