<?php

namespace Database\Seeders;

use App\Models\Inclusion;
use App\Models\Room;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::factory(40)->create()->each(function ($room) {
            $inclusionIds = Inclusion::inRandomOrder()->limit(5)->pluck('id');
            $room->inclusions()->sync($inclusionIds);
        });
    }
}
