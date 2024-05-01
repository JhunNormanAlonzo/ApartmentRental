<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Jhun Norman Alonzo',
            'email' => 'jalonzo@diavox.net',
            'password' => bcrypt('admin123')
        ]);
        $user->assignRole('Super Admin');

        $user = User::create([
            'name' => 'Jessa Mae Matutino',
            'email' => 'jessamaematutino@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        $user->assignRole('Tenant');
        Tenant::create([
            'user_id' => $user->id,
            'room_id' => 1,
            'contact_number' => '09275220774',
            'address' => 'sa puso ni jhun',
            'registration_date' => '2024-01-01'
        ]);
    }
}
