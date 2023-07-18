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
            // 'end_date' =>  $this->faker->dateTimeThisYear,
            'company_name' => $this->faker->streetName,
            'request' => $this->faker->text,
            'response' => $this-> faker -> text,
            'status' => $this->faker->randomElement(['Assigned', 'Unassigned', 'InProgress', 'Completed']),
            'is_active' => $this ->faker->boolean(80),
            'members_assigned' => [],
            'new_attachment' => null,
        ];
    }
}
