<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'first_name' => 'Trafalgar',
        //     'last_name' => 'Law',
        //     'staff_number' => 'ICTA/00012',
        //     'email' => 'trafalgarlaw@gmail.com',
        //     'password' => ('secret'),
        //     'is_active' => (1),
        // ]);

        User::factory()->count(5)->create();
    }
}
