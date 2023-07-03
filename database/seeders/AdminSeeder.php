<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Admin::factory()-> create([
            'first_name' => 'Beverly',
            'last_name' => 'Hills',
            'email' => 'beverleyHills@gmail.com',
            'password' => ('secret'),
            'is_active' => (1),
        ]);

        Admin::factory() -> count(5) -> create();
    }

}
