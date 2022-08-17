<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'email' => 'admin@gmail.com'
        ])->giveAdminPermissions();

        // создаём админу телефон (для привязки к объявлениям)
        /** @var \App\Models\UserPhone */
        $phone = $admin->phones()->create([
            'number' => '+79001234567'
        ]);
        $phone->setVerified(true);
    }
}
