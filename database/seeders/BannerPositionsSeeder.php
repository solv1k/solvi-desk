<?php

namespace Database\Seeders;

use App\Models\BannerPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerPositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
