<?php

namespace Database\Factories;

use App\Models\Home;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Home>
 */
class HomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * Generates realistic heritage home data with Philippine locations.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $philippineLocations = [
            'Intramuros, Manila',
            'Cebu City, Cebu',
            'Silay City, Negros Occidental',
            'Vigan City, Ilocos Sur',
            'Iloilo City, Iloilo',
            'Zamboanga City, Zamboanga del Sur',
            'Bacolod City, Negros Occidental',
            'Davao City, Davao del Sur',
            'Cagayan de Oro, Misamis Oriental',
            'Pangasinan Province, Luzon',
        ];

        return [
            'house_name' => $this->faker->catchPhrase(),
            'location' => $this->faker->randomElement($philippineLocations),
            'img_url' => $this->faker->imageUrl(600, 400, 'architecture'),
        ];
    }
}
