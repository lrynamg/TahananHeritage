<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Generates 8 realistic heritage home records with names, locations, and image URLs.
     */
    public function run(): void
    {
        Home::factory(8)->create();
    }
}
