<?php

namespace Database\Seeders;

use App\Models\Founder;
use Illuminate\Database\Seeder;

class FounderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Generates 10 realistic founder records with names, positions, and image URLs.
     */
    public function run(): void
    {
        Founder::factory(10)->create();
    }
}
