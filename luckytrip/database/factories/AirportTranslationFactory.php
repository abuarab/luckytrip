<?php

namespace Database\Factories;

use App\Models\Airport;
use App\Models\AirportTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AirportTranslation>
 */
class AirportTranslationFactory extends Factory
{
    protected $model = AirportTranslation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
//        $faker = $this->faker;
//
//        return [
//            'airport_id' => function () {
//                return Airport::factory()->create()->id;
//            },
//            'language_code' => 'en',
//            'name' => $faker->name,
//            'description' => $faker->text,
//            'terms_and_conditions' => $faker->text,
//        ];
    }
}
