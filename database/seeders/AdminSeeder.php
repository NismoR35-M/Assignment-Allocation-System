<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Admin::firstOrCreate([
            'email' => 'beverleyHiii@gmail.com',
        ], [
            'first_name' => 'Beverly',
            'last_name' => 'Kay',
            'password' => Hash::make('secret'),
            'is_active' => 1,
        ]);

        Admin::factory()->count(8)->create();
    }

}

