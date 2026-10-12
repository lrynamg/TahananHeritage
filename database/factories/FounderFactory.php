<?php

namespace Database\Factories;

use App\Models\Founder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Founder>
 */
class FounderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'position' => $this->faker->jobTitle(),
            'img_url' => $this->faker->imageUrl(),
        ];
    }
}
