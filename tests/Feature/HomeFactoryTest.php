<?php

namespace Tests\Feature;

use App\Models\Home;
use Tests\TestCase;

class HomeFactoryTest extends TestCase
{
    /**
     * Test that HomeFactory class exists and is properly configured.
     */
    public function test_home_factory_exists(): void
    {
        // Verify the HomeFactory class exists
        $factory = Home::factory();
        $this->assertNotNull($factory);
    }

    /**
     * Test that HomeFactory definition returns required fields.
     */
    public function test_home_factory_definition_returns_required_fields(): void
    {
        // Get a factory instance and call make (doesn't persist to DB)
        $home = Home::factory()->make();

        // Assert all required fields are populated
        $this->assertNotEmpty($home->house_name);
        $this->assertNotEmpty($home->location);

        // Assert field types
        $this->assertIsString($home->house_name);
        $this->assertIsString($home->location);

        // Assert field length constraints
        $this->assertLessThanOrEqual(200, strlen($home->house_name));
        $this->assertLessThanOrEqual(200, strlen($home->location));
    }

    /**
     * Test that HomeFactory uses Philippine locations.
     */
    public function test_home_factory_uses_philippine_locations(): void
    {
        // Generate multiple homes to increase chance of getting different locations
        $homes = Home::factory(10)->make();

        // Expected Philippine locations from the factory
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

        // Verify each home's location is from the Philippine locations list
        foreach ($homes as $home) {
            $this->assertContains($home->location, $philippineLocations);
        }
    }

    /**
     * Test that HomeFactory generates img_url using catchPhrase for house_name.
     */
    public function test_home_factory_generates_catch_phrase_house_name(): void
    {
        // Generate multiple homes to verify consistency
        $homes = Home::factory(5)->make();

        foreach ($homes as $home) {
            // Verify house_name is not empty (should be a catch phrase)
            $this->assertNotEmpty($home->house_name);
            $this->assertIsString($home->house_name);
            // Verify it's a reasonable length for a catch phrase
            $this->assertGreaterThan(5, strlen($home->house_name));
        }
    }

    /**
     * Test that HomeFactory generates image URL.
     */
    public function test_home_factory_generates_img_url(): void
    {
        // Generate a home
        $home = Home::factory()->make();

        // Assert img_url is generated and is a valid URL-like string
        $this->assertNotEmpty($home->img_url);
        $this->assertIsString($home->img_url);
        $this->assertStringContainsString('placeholder', $home->img_url);
    }
}
