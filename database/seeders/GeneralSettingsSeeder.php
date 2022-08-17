<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
