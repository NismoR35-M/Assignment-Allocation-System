<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Junction;

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
    protected $model = \App\Models\Assignment::class;

    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $randomUserIds = $this->faker->randomElements($userIds, 5); 
        return [
            'name' => $this->faker->streetName,
            'company_name' => $this->faker->company,
            'request_type' => $this->faker->word,
            'description' =>  $this->faker->sentence,
            'start_date' =>  $this->faker->dateTimeThisYear,
            'status' => $this->faker->randomElement(['Assigned', 'Unassigned', 'In Progress', 'Completed']),
            'request_file' => null,
            'file_type' => null,
            'response' => null,
            'is_active' => $this ->faker->boolean(80),
            'members_assigned' => json_encode($randomUserIds),
            'new_attachment' => null,
        ];
    }

}
