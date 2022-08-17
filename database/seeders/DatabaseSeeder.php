<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Advert;
use App\Models\AdvertCategory;
use App\Models\BannerPosition;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserPhone;
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
        /** @var \App\Models\User */
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com'
        ])->giveAdminPermissions();

        // создаём админу телефон (для привязки к объявлениям)
        /** @var \App\Models\UserPhone */
        $phone = $admin->phones()->create([
            'number' => '+79001234567'
        ]);
        $phone->setVerified(true);

        // создаем основные категории объявлений
        $advert_category = AdvertCategory::create([
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

        // создаём тестовое объявление
        Advert::factory()
                ->hasOwner(User::find(1))
                ->hasCategory($advert_category)
                ->create()
                ->setSelectedUserPhone($phone->id, 'Vladimir')
                ->setActiveStatus();

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
