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
            'company_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' =>$this ->faker->  phoneNumber,
            'status' => $this ->faker->boolean(100),
            'is_active' => $this ->faker->boolean(80),
        ];
    }
}
