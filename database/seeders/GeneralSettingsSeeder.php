<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

final class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // создаём основные настройки
        GeneralSetting::create([
            'key' => 'currency',
            'value' => 'Рубли РФ',
        ]);
        GeneralSetting::create([
            'key' => 'currency_symbol',
            'value' => 'RUB',
        ]);
    }
}
