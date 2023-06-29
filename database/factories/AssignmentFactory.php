<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'request_type' => $this->faker->name,
            'description' =>  $this->faker->name,
            'start_date' =>  $this->faker->dateTimeThisYear,
            'company_name' => $this->faker->streetName,
            'status' => $this ->faker->boolean(100),
            'is_active' => $this ->faker->boolean(80),
        ];
    }
}
