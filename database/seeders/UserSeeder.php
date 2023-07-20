<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Ella',
            'last_name' => 'Mai',
            'staff_number' => 'ICTA/00014',
            'email' => 'ellamai@gmail.com',
            'password' => Hash::make('secret'),
            'is_active' => 1,
        ]);

        User::factory()->count(5)->create();
    }
}
