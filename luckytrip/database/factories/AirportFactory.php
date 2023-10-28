<?php

namespace Database\Factories;

use App\Models\Airport;
use App\Models\AirportTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AirportFactory extends Factory
{
    protected $model = Airport::class;

    public function definition()
    {
        return [
            'iata_code' => strtoupper(Str::random(3)),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Airport $airport) {
            $languages = ['en', 'fr', 'de'];
            foreach ($languages as $language) {
                AirportTranslation::factory()->create([
                    'airport_id' => $airport->id,
                    'language_code' => $language,
                    'name' => $this->faker->name,
                    'description' => $this->faker->text,
                    'terms_and_conditions' => $this->faker->text,
                ]);
            }
        });
    }
}
