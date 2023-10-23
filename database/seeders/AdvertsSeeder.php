<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Advert;
use App\Models\AdvertCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

final class AdvertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
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
