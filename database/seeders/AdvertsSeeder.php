<?php

namespace Database\Seeders;

use App\Models\Advert;
use App\Models\AdvertCategory;
use App\Models\User;
use App\Models\UserPhone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // создаём тестовое объявление
        Advert::factory()
                ->hasOwner(User::find(1))
                ->hasCategory(AdvertCategory::find(1))
                ->create()
                ->setSelectedUserPhone(1, 'Test User')
                ->setActiveStatus();
    }
}
