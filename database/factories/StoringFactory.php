<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Storing;
use App\Models\Klant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Storing>
 */
class StoringFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naam' => $this->faker->sentence(3),
            'beschrijving' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['open', 'in behandeling', 'opgelost']),
            'locatie' => $this->faker->address(),
            'bedrijf' => $this->faker->company(),
            'datum' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'klant_id' => Klant::factory(),
            'monteur' => null,
        ];
    }
}
