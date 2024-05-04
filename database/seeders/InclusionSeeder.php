<?php

namespace Database\Seeders;

use App\Models\Inclusion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InclusionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inclusion::factory(10)->create();
    }
}
