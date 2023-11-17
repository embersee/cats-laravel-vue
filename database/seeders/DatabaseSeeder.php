<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cat;
use App\Models\Breed;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Breed::factory(5)->create();

        Cat::factory(10)->create();
    }
}
