<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->monthName(),
            'description' => fake()->text(20),
            'price' => fake()->numberBetween(10, 100),
            'duration' => fake()->numberBetween(1, 12)
        ];
    }

    public function trial(): Factory
    {
        return $this->state(function () {
            return [
                'name' => 'New User Trial',
                'description' => 'New User Trial Plan (Dont Delete)',
                'price' => '0.00',
                'duration' => '3',
                'duration_unit' => 'month',
            ];
        });
    }
}
