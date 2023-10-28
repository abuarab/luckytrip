<?php

namespace Tests\Feature;

use App\Models\Airport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AirportTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    public function a_user_can_add_airport(): void {

        $airportData = [
            'iata_code' => 'ABC',
            'latitude' => 38.8951,
            'longitude' => -77.0364,
            'translations' => [
                [
                    'language_code' => 'en',
                    'name' => 'ABC Airport',
                    'description' => 'Description in English',
                    'terms_and_conditions' => 'Terms in English',
                ],
            ],
        ];

        $response = $this->post('/api/airports', $airportData);
        $response->assertStatus(201);

    }

    public function test_show_method_with_nonexistent_airport(): void {
        $response = $this->get('/api/airports/999');

        $response->assertStatus(404);
    }

    public function test_show_method_with_existent_airport(): void {
        $airport = Airport::factory()->create();
        $response = $this->get("/api/airports/{$airport->id}");

        $response->assertStatus(200);
    }

    public function test_delete_airport() {
        $airport = Airport::factory()->create();
        $response = $this->delete("/api/airports/{$airport->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('airports', ['id' => $airport->id]);
    }

    public function test_update_airport() {
        $airport = Airport::factory()->create();

        $updatedData = [
            'iata_code' => 'ABC',
            'latitude' => 40.7128,
            'longitude' => -74.0060,
        ];

        $response = $this->put("/api/airports/{$airport->id}", $updatedData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('airports', array_merge(['id' => $airport->id], $updatedData));
    }
}
