<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // создаём админа
        /** @var \App\Models\User */
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'super@admin.com'
        ])->giveAdminPermissions();

        // создаём админу телефон (для привязки к объявлениям)
        $admin->phones()->create([
            'number' => '+79001234567',
            'verified' => true
        ]);
    }
}
